<?php

use App\Livewire\Home;
use App\Livewire\Sobre;
use App\Livewire\Cases;
use App\Livewire\Contato;
use App\Livewire\Post\Show as PostShow;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/sobre', Sobre::class)->name('sobre');
Route::get('/cases', Cases::class)->name('cases');
Route::get('/contato', Contato::class)->name('contato');
Route::get('/blog', Home::class)->name('blog'); // Temporariamente usando Home
Route::get('/article/{post:slug}', PostShow::class)->name('post.show');
