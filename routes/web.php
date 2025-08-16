<?php

use Illuminate\Support\Facades\Route;

Route::get('/', App\Livewire\Blog\Homepage::class)->name('home');
