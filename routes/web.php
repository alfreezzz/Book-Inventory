<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\Book::class, 'index']);

Route::resource('books', App\Http\Controllers\Book::class);
Route::get('procurement', App\Http\Controllers\Book::class . '@sortByStock');
Route::resource('publishers', App\Http\Controllers\Publisher::class);

// Admin routes
Route::get('admin', function () {
    return view('admin.index');
})->name('admin.dashboard');
