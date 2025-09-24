<?php

namespace App\Livewire\Client;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Spatie\SchemaOrg\Schema;

class Login extends Component
{
    public $email = '';
    public $password = '';
    public $remember = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    protected $messages = [
        'email.required' => 'E-mail é obrigatório',
        'email.email' => 'Digite um e-mail válido',
        'password.required' => 'Senha é obrigatória',
        'password.min' => 'Senha deve ter pelo menos 6 caracteres',
    ];

    public function mount()
    {
        if (Auth::check() && Auth::user()->role === 'client') {
            return redirect()->route('client.dashboard');
        }
    }

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password, 'role' => 'client'], $this->remember)) {
            session()->regenerate();
            return redirect()->intended(route('client.dashboard'));
        }

        $this->addError('email', 'Credenciais incorretas.');
    }

    public function render()
    {
        seo()
            ->title($title = 'Login - Área do Cliente - Global SST')
            ->description($description = 'Acesse sua área do cliente da Global SST para acompanhar suas solicitações de CAT e PPP.')
            ->canonical($url = route('client.login'))
            ->addSchema(
                Schema::webPage()
                    ->name($title)
                    ->description($description)
                    ->url($url)
            );

        return view('livewire.client.login');
    }
}