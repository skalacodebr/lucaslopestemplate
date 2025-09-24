<?php

namespace App\Providers;

use Filament\Support\Facades\FilamentView;
use Illuminate\Support\ServiceProvider;
use App\Models\Billing;
use App\Observers\BillingObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        FilamentView::registerRenderHook(
            'panels::head.start',
            fn (): string => '<meta name="robots" content="noindex,nofollow">'
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Billing::observe(BillingObserver::class);
    }
}
