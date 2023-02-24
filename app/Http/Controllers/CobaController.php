<?php
namespace App\Http\Controllers;
use App\Models\Book;

class CobaController extends Controller {
    public function cobaMVC(){
        #1. ambil semua data buku
        $books = Book::all();
        #2. return view dengan mengirimkan data books
        return view('list_books', [
            'books' => $books
        ]);
    }
    public function index(){
        echo "Ini adalah function index di CobaController";
    }
    public function testing() {
        echo "Ini adalah function testing di CobaController";
    }
    public function cobaView() {
        $nama = "Joko";
        return view('coba_view', [
            'nama' => $nama
        ]);
        #echo "Ini adalah function cobaView di CobaController";
    }
    public function cobaModel() {
        #get all data
        Book::all();
        
        #get By Primary Key
        Book::find();
        
        #$books = Book::FindOrFail;
        #dd($books);
    }
}