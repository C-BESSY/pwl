<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Publisher;
use App\Models\BookAuthor;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use App\Export\ExportBooks;

class BookController extends BaseController
{
    #fungsi untuk menampilkan semua data buku
    public function index()
    {
        $books = Book::query()
            ->with('publisher', 'authors')
            ->when(request('search'), function ($query) {
                $searchTerm = '%' . request('search') . '%';
                $query->where('title', 'LIKE', $searchTerm)
                    ->orWhere('code', 'LIKE', $searchTerm)
                    ->orWhereHas('publisher', function ($query) use ($searchTerm) {
                        $query->where('name', 'LIKE', $searchTerm);
                    })
                    ->orWhereHas('authors', function ($query) use ($searchTerm) {
                        $query->where('name', 'LIKE', $searchTerm);
                    });
            })->paginate(10);
        session()->flashInput(request()->input());
        return view('books/index', [
            'books' => $books
        ]);
    }

    public function print() 
    {
        $books = Book::query()
            ->with(['publisher', 'authors'])
            ->when(request('search'), function ($query) {
                $searchTerm = '%' . request('search') . '%';
                $query->where('title', 'like', $searchTerm)
                    ->orWhere('code', 'like', $searchTerm)
                    ->orWhereHas('publisher', function($query) use ($searchTerm) {
                        $query->where('name','like',$searchTerm);
                    })
                    ->orWhereHas('authors', function($query) use ($searchTerm) {
                        $query->where('name','like',$searchTerm);
                    });
            })->get();
        $filename = "books_".date('Y-m-d-H-i-s').".PDF";
        $pdf = Pdf::loadView('books/print', ['books'=>$books]);
        $pdf->setPaper('A4','Portrait');
        return $pdf->stream($filename);
    }

    public function printDetail($bookId)
    {
        $book = Book::findOrFail($bookId);
        $filename = "book_" . $book->code . "_" . date('Y-m-d-H-i-s') . ".pdf";
        $pdf = Pdf::loadView('books/printDetail', ['book'=>$book]);
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream($filename);
    }

    #function untuk menampilkan form tambah baru
    public function create()
    {
        $this->adminAndSuperAdminOnly();
        $publishers = Publisher::all();
        $authors = Author::all();

        return view('books/form', [
            'publishers' => $publishers,
            'authors' => $authors
        ]);
    }

    #fungsi untuk memproses buku kedalam database
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validate = $request->validate([
                'code' => 'required|max:4|unique:books,code',
                'title' => 'required|max:100',
                'id_author' => 'required',
                'id_publisher' => 'required'
            ]);
    
            $code = $request->code;
            $title = $request->title;
            $idAuthor = $request->id_author;
            $idPublisher = $request->id_publisher;
            $book = Book::create([
                'code' => $code,
                'title' => $title,
                'id_publisher' => $idPublisher
            ]);
    
            foreach ($request->author as $authorId) {
                BookAuthor::create([
                    'id_book' => $book->id,
                    'id_author' => $authorId
                ]);
            }
            DB::commit();
    
            #untuk mengembalikan ke halaman yang dituju
            return redirect(route('books.index'))->with('sukses', 'Buku Sukses di Tambah.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect(route('books.index'))->with('error', 'Buku Gagal di Tambah.');
        }
    }

    public function confirmDelete($bookId)
    {
        $this->superadminOnly();
        #ambil data buku by Id
        $book = Book::findOrFail($bookId);
        $publishers = Publisher::all();
        return view('books/delete-confirm', [
            'book' => $book,
            'publishers' => $publishers
        ]);
    }

    public function delete(Request $request)
    {
        $bookId = $request->id;
        $book = Book::findOrFail($bookId);
        $book->delete();
        return redirect(route('books.index'));
    }

    public function edit($bookId)
    {
        #ambil data buku by Id
        $book = Book::findOrFail($bookId);
        $authorArray = $book->authors()->pluck("id_author")->toArray();
        $authors = Author::all();
        $publishers = Publisher::all();
        return view('books/form-update', [
            'book' => $book,
            'publishers' => $publishers,
            'authors' => $authors,
            "authorArray" => $authorArray
        ]);
    }

    public function update(Request $request)
    {
        $validate = $request->validate([
            'code' => 'required|max:4',
            'title' => 'required|max:100',
            'id_author' => 'required',
            'id_publisher' => 'required'
        ]);
        $bookId = $request->id;
        $book = Book::findOrFail($bookId);

        $book->update([
            'title' => $request->title,
            'id_publisher' => $request->id_publisher
        ]);
        $book->authors()->sync($request->id_author);

        return redirect(route('books.index'))->with('sukses', 'Data Buku Sukses di Update.');
    }

    public function excel()
    {
        return Excel::download(new ExportBooks, 'books.xlsx');
    }
}