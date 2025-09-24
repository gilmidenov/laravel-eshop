<?php

use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', \App\Livewire\HomeComponent::class)->name('home');
Route::get('/category', \App\Livewire\Product\CategoryComponent::class)->name('category');
Route::get('/product', \App\Livewire\Product\ProductComponent::class)->name('product');
