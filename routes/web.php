<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    dD(app()->getLocale());
    return view('welcome');
});

Route::get('/change_lang/{lang}', function ($lang) {
    app()->setLocale($lang);
});


// Books
Route::controller(BookController::class)->prefix('books')->middleware('lang')->group(function () {
    // update
    Route::post('/update/{id}', 'update')->name("books.update");
    Route::get('/edit/{id}', 'edit')->name("books.edit");
    // delete
    Route::get('/delete/{id}', 'delete')->name("books.delete");
    // create
    Route::get('/create', 'create')->name("books.create");
    Route::post('/store', 'store')->name("books.store");
    // show
    Route::get('', 'index')->name("books");
    Route::get('/{id}', 'show')->name('books.show');
});

// Authors
Route::controller(AuthorController::class)->prefix('authors')->group(function () {
    // update
    Route::post('/update/{id}', 'update')->name("authors.update");
    Route::get('/edit/{id}', 'edit')->name("authors.edit");
    // delete
    Route::get('/delete/{id}', 'delete')->name("authors.delete");
    // create
    Route::get('/create', 'create')->name("authors.create");
    Route::post('/store', 'store')->name("authors.store");
    // show
    Route::get('', 'index')->name("authors");
    Route::get('/{id}', 'show')->name('authors.show');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
