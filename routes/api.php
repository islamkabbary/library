<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




// Route::get('/books', [BookController::class, 'index']);
// // Route::get('/books/{id?}', [BookController::class, 'show']);
// Route::get('/books/{id}', [BookController::class, 'show']);
// Route::post('/books', [BookController::class, 'store']);
// // Route::put('/books/{id}', [BookController::class, 'update']);
// Route::patch('/books/{id}', [BookController::class, 'update']);
// Route::delete('/books/{id}', [BookController::class, 'delete']);




Route::resource('/books' , BookController::class)->middleware("auth:api");




// Auth
Route::Post('my-register', [AuthController::class, 'my_register']);
Route::Post('my-login', [AuthController::class, 'my_login']);
