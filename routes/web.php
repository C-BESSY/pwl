<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CobaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layout.main');
});

#CRUD books
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
Route::post('/books/store', [BookController::class, 'store'])->name('books.store');
#delete
Route::get('/books/{bookId}/delete-confirm', [BookController::class, 'confirmDelete'])
    ->name('books.del.confirm');
#books/3/confirm-delete
Route::post('/books/delete',[BookController::class,'delete'])->name('books.delete');
#update-book
Route::get('/books/{bookId}/edit', [BookController::class, 'edit'])->name('books.edit');
Route::post('/books/update', [BookController::class, 'update'])->name('books.update');


Route::get('/test', function () {
    echo "Hello World";
});
Route::get('/test/{nama}/{umur}', function ($nama, $umur) {
    echo "Hello World " . $nama . ' ' . $umur;
});

Route::get('/produk/baru', function () {
    echo "Ini adalah halaman Produk";
});

Route::get('/coba', [CobaController::class, 'index']);
Route::get('/coba/lagi', [CobaController::class, 'testing']);
Route::get('/coba/view', [CobaController::class, 'cobaView']);
Route::get('/coba/model', [CobaController::class, 'cobaModel']);
Route::get('/coba/mvc', [CobaController::class, 'cobaMVC']);

#Route::g
#php artisan serve