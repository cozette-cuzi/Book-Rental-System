<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/statistics', [HomeController::class, 'statistics'])->name('statistics');


Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
Route::post('books/{id}/borrow', [BookController::class, 'borrow'])->name('books.borrow');


Route::apiResource('/genres', GenreController::class);
Route::apiResource('/books', BookController::class);
Route::apiResource('/borrows', BorrowController::class);
