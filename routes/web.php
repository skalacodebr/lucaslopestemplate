<?php

use App\Livewire\Home;
use App\Livewire\About;
use App\Livewire\Services;
use App\Livewire\Contact;
use App\Livewire\Forms\Cat;
use App\Livewire\Forms\Ppp;
use App\Livewire\Post\Show as PostShow;
use Illuminate\Support\Facades\Route;

// Páginas principais
Route::get('/', Home::class)->name('home');
Route::get('/sobre', About::class)->name('about');
Route::get('/servicos', Services::class)->name('services');
Route::get('/contato', Contact::class)->name('contact');

// Blog (mantendo rota existente)
Route::get('/blog', Home::class)->name('blog');
Route::get('/article/{post:slug}', PostShow::class)->name('post.show');

// Formulários específicos
Route::get('/formularios/cat', Cat::class)->name('forms.cat');
Route::get('/formularios/ppp', Ppp::class)->name('forms.ppp');

// Área do Cliente
Route::get('/cliente/login', App\Livewire\Client\Login::class)->name('client.login');
Route::middleware('auth')->group(function () {
    Route::get('/cliente/dashboard', App\Livewire\Client\Dashboard::class)->name('client.dashboard');
});
