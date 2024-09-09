<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::post('/books/update/{id}', [BookController::class , 'update'])->name("books.update");
Route::get('/books/edit/{id}', [BookController::class , 'edit'])->name("books.edit");
Route::get('/books/create', [BookController::class , 'create'])->name("books.create");
Route::post('/books/store', [BookController::class , 'store'])->name("books.store");
Route::get('/books', [BookController::class , 'index'])->name("books");
Route::get('/books/{id}', [BookController::class , 'show'])->name('books.show');
