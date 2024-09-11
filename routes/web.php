<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;

Route::get('/', function () {
    return view('welcome');
});



// Books
Route::controller(BookController::class)->prefix('books')->group(function () {
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
