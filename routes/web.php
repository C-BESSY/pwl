<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CobaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PublisherController;
use App\Mail\TestMail;
use App\Models\Book;
use App\Models\Publisher;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layout.main');
});

#Route Register
Route::get('register', function(){
    return view('login.register');
})->name('register');
Route::post('register', [LoginController::class, 'prosesRegister'])->name('register.proses');
Route::get('register/verify', [LoginController::class, 'registerVerify'])->name('register.verify');

#Route Login
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login/verify', [LoginController::class, 'verify'])->name('login.verify');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

#Rooute Harus Login
Route::group(['middleware' => 'pwl.auth'], function (){
    Route::get('/', function() {
        return view('layout.main');
    });
    #CRUD Books
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books/store', [BookController::class, 'store'])->name('books.store');
    Route::get('/books/{bookId}/delete-confirm', [BookController::class, 'confirmDelete'])->name('books.del.confirm');
    Route::post('/books/delete', [BookController::class, 'delete'])->name('books.delete');
    Route::get('/books/{bookId}/update', [BookController::class, 'edit'])->name('books.edit');
    Route::post('/books/update-confirm', [BookController::class, 'update'])->name('books.update');
    Route::get('/books/{bookId}/delete-confirm', [BookController::class, 'confirmDelete'])->name('books.del.confirm');
    Route::get('/books/print', [BookController::class,'print'])->name('books.print');
    Route::get('/books/print/{bookId}', [BookController::class,'printDetail'])->name('books.print.detail');
    Route::get('/books/export/excel', [BookController::class,'excel'])->name('books.export.excel');
});

#CRUD books
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
Route::post('/books/store', [BookController::class, 'store'])->name('books.store');
#delete
Route::get('/books/{bookId}/delete-confirm', [BookController::class, 'confirmDelete'])->name('books.del.confirm');
#books/confirm-delete
Route::post('/books/delete', [BookController::class, 'delete'])->name('books.delete');
#update-book
Route::get('/books/{bookId}/update', [BookController::class, 'edit'])->name('books.edit');
Route::post('/books/update-confirm', [BookController::class, 'update'])->name('books.update');
Route::get('/books/{bookId}/delete-confirm', [BookController::class, 'confirmDelete'])->name('books.del.confirm');
Route::get('/books/print', [BookController::class,'print'])->name('books.print');
Route::get('/books/print/{bookId}', [BookController::class,'printDetail'])->name('books.print.detail');
Route::get('/books/export/excel', [BookController::class,'excel'])->name('books.export.excel');


#CRUD authors
Route::get('/authors', [AuthorController::class, 'index'])->name('authors.index');
Route::get('/authors/create', [AuthorController::class, 'create'])->name('authors.create');
Route::post('/authors/store', [AuthorController::class, 'store'])->name('authors.store');

#update-book
Route::get('/authors/{authorId}/update', [AuthorController::class, 'edit'])->name('authors.edit');
Route::post('/authors/update-confirm', [AuthorController::class, 'update'])->name('authors.update');
Route::get('/authors/{authorId}/delete-confirm', [AuthorController::class, 'confirmDelete'])->name('authors.del.confirm');

#delete
Route::get('/authors/{authorId}/delete-confirm', [AuthorController::class, 'confirmDelete'])->name('authors.del.confirm');

#authors/3/confirm-delete
Route::post('/authors/delete', [AuthorController::class, 'delete'])->name('authors.delete');


#CRUD publishers
Route::get('/publishers', [PublisherController::class, 'index'])->name('publishers.index');
Route::get('/publishers/create', [PublisherController::class, 'create'])->name('publishers.create');
Route::post('/publishers/store', [PublisherController::class, 'store'])->name('publishers.store');

#update-book
Route::get('/publishers/{publisherId}/update', [PublisherController::class, 'edit'])->name('publishers.edit');
Route::post('/publishers/update-confirm', [PublisherController::class, 'update'])->name('publishers.update');
Route::get('/publishers/{publisherId}/delete-confirm', [PublisherController::class, 'confirmDelete'])->name('publishers.del.confirm');

#delete
Route::get('/publishers/{publisherId}/delete-confirm', [PublisherController::class, 'confirmDelete'])->name('publishers.del.confirm');

#publishers/3/confirm-delete
Route::post('/publishers/delete', [PublisherController::class, 'delete'])->name('publishers.delete');


Route::get('/test', function () {
    echo 'Hello World';
});

Route::get('/test/{nama}/{umur}', function ($nama, $umur) {
    echo 'Hello World ' . $nama . ' ' . $umur;
});

Route::get('/produk/baru', function () {
    echo 'Ini adalah produk baru';
});

Route::get('/coba', [CobaController::class, 'index']);
Route::get('/coba/lagi', [CobaController::class, 'testing']);
Route::get('/coba/view', [CobaController::class, 'cobaView']);
Route::get('/coba/model', [CobaController::class, 'cobaModel']);
Route::get('/coba/mvc', [CobaController::class, 'cobaMVC']);


Route::get('/coba-model', function () {
    $books = Book::with('publisher')->get();
    dd($books);
    foreach ($books as $book) {
        echo $book->code . ' - ' . $book->publisher->id . '<br/>';
    }
    dd();
});

Route::get('/coba-pub', function () {
    $publishers = Publisher::with('books')->get();
    foreach ($publishers as $p) {
        echo $p->name . ' (';
        foreach ($p->books as $b) {
            echo $b->title . ', ';
        }
        echo ')<br>';
    }

    $book = Book::with('authors')->first();
    dd($book);
});



#email
Route::get('/mail/test', function () {
    Mail::to('xodabi7530@in2reach.com')->send(new TestMail());
});


#php artisan serve