<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Fungsi untuk menampilkan semua data books
     */
    public function index()
    {
        return view('books/index', [
            'books' => Book::all(),
        ]);
    }

    /**
     * Function untuk menampilkan form tambah buku
     */
    public function create()
    {
        return view('books/form');
    }

    /**
     * Function untuk memproses data buku ke database
     */
    public function store(Request $request)
    {
        $code = $request->code;
        $title = $request->title;
        Book::create([
            'code' => $code,
            'title' => $title
        ]);
        return redirect(route('books.index'))->with('success', 'Buku berhasil ditambah');
    }

    public function confirmDelete($bookId)
    {
        #ambil data buku by Id
        $book = Book::findOrFail($bookId);
        return view('books/delete-confirm', [
            'book' => $book
        ]);
    }

    public function delete(Request $request)
    {
        $bookId = $request->id;
        $book = Book::findOrFail($bookId);
        $book->delete();
        return redirect(route('books.index'))->with('success', 'Buku berhasil dihapus');
    }

    public function edit($bookId)
    {
        #ambil data buku by Id
        $book = Book::findOrFail($bookId);
        return view('books/form-update', [
            'book' => $book
        ]);
    }

    public function update(Request $request)
    {
        $bookId = $request->id;
        $book = Book::findOrFail($bookId);
        $book->update([
            'title' => $request->title
        ]);
        return redirect(route('books.index'))->with('success', 'Buku berhasil diubah');
    }
}
