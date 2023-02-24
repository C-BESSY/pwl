<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    #untuk menampilkan semua data books
    public function index(){ #bisa book.index/books/index
        return view('books/index', [
            'books' => Book::all()
        ]); 
    }

    #untuk menampilkan form tambah buku
    public function create(){ #bisa book.index/books/index
        return view('books/form'); 
    }

    #untuk menampilkan form tambah buku
    public function store(Request $request){ #bisa book.index/books/index
        $code = $request->code;
        $title = $request->title;
        Book::create([
            'code' => $code,
            'title' => $title
        ]);
        return redirect(route('books.index'))->with('succes', 'Buku Berhasil Ditambah');
    }
}
