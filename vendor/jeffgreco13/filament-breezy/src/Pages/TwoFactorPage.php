<?php

namespace Jeffgreco13\FilamentBreezy\Pages;

use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
// use Filament\Pages\CardPage;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Http\Controllers\Auth\LogoutController;
use Filament\Pages\Concerns\InteractsWithFormActions;
use Filament\Pages\SimplePage;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Livewire\Attributes\Url;

class TwoFactorPage extends SimplePage
{
    use InteractsWithFormActions;
    use WithRateLimiting;

    protected static string $view = 'filament-breezy::filament.pages.two-factor';

    protected bool $hasTopbar = false;

    public $usingRecoveryCode = false;

    public $code;

    #[Url]
    public ?string $next;

    public function getTitle(): string
    {
        return __('filament-breezy::default.two_factor.heading');
    }

    public function getSubheading(): string
    {
        return __('filament-breezy::default.two_factor.description');
    }

    public function mount()
    {
        if (! Filament::auth()->check()) {
            return redirect()->to(Filament::getLoginUrl());
        } elseif (filament('filament-breezy')->auth()->user()->hasValidTwoFactorSession()) {
            return redirect()->to(Filament::getHomeUrl());
        }
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('code')
                ->label($this->usingRecoveryCode ? __('filament-breezy::default.fields.2fa_recovery_code') : __('filament-breezy::default.fields.2fa_code'))
                ->placeholder($this->usingRecoveryCode ? __('filament-breezy::default.two_factor.recovery_code_placeholder') : __('filament-breezy::default.two_factor.code_placeholder'))
                ->hint(new HtmlString(Blade::render('
                    <x-filament::link href="#" wire:click="toggleRecoveryCode()">'.($this->usingRecoveryCode ? __('filament-breezy::default.cancel') : __('filament-breezy::default.two_factor.recovery_code_link')).'
                    </x-filament::link>')))
                ->required()
                ->extraInputAttributes(['class' => 'text-center', 'autocomplete' => $this->usingRecoveryCode ? 'off' : 'one-time-code'])
                ->autofocus()
                ->suffixAction(
                    Forms\Components\Actions\Action::make('cancel')
                        ->ToolTip(__('filament-breezy::default.cancel'))
                        ->icon('heroicon-o-x-circle')
                        ->action(function () {
                            Filament::auth()->logout();
                            $this->mount();
                        })
                ),
        ];
    }

    public function toggleRecoveryCode()
    {
        $this->resetErrorBag('code');
        $this->code = null;
        $this->usingRecoveryCode = ! $this->usingRecoveryCode;
    }

    public function hasValidCode()
    {
        if ($this->usingRecoveryCode) {
            return $this->code && collect(filament('filament-breezy')->auth()->user()->two_factor_recovery_codes)->first(function ($code) {
                return hash_equals($this->code, $code) ? $code : false;
            });
        } else {
            return $this->code && filament('filament-breezy')->verify(code: $this->code);
        }
    }

    protected function hasFullWidthFormActions(): bool
    {
        return true;
    }

    /**
     * @return array<Action | ActionGroup>
     */
    protected function getFormActions(): array
    {
        return [
            $this->getAuthenticateFormAction(),
        ];
    }

    protected function getAuthenticateFormAction(): Action
    {
        return Action::make('authenticate')
            ->label(__('filament-panels::pages/auth/login.form.actions.authenticate.label'))
            ->submit('authenticate');
    }

    public function logout()
    {
        return app(LogoutController::class);
    }

    public function authenticate()
    {
        $code = data_get($this->form->getState(), 'code', null);
        try {
            $this->rateLimit(5);
        } catch (TooManyRequestsException $exception) {
            $this->addError('code', __('filament::login.messages.throttled', [
                'seconds' => $exception->secondsUntilAvailable,
                'minutes' => ceil($exception->secondsUntilAvailable / 60),
            ]));

            return null;
        }

        if (! $this->hasValidCode()) {
            $this->addError('code', __('filament-breezy::default.profile.2fa.confirmation.invalid_code'));

            return null;
        }

        // If using a recovery code, unset it so it can only be used once
        if ($this->usingRecoveryCode) {
            filament('filament-breezy')->auth()->user()->destroyRecoveryCode($this->code);
        }

        // If it makes it to the bottom, we're going to set the session var and send them to the dashboard.
        filament('filament-breezy')->auth()->user()->setTwoFactorSession();

        return redirect()->to($this->next ?? Filament::getHomeUrl());
    }
}
