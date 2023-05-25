<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::query()
            ->when(request('search'), function ($query) {
                $searchTerm = '%' . request('search') . '%';
                $query->where('name', 'like', $searchTerm);
            })->paginate(10);
        return view('authors/index', [
            'authors' => $authors
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('authors/form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|unique:authors,name',
        ]);

        $name = $request->name;
        Author::create([
            'name' => $name,
        ]);

        return redirect(route('authors.index'))->with('Success', 'Author Berhasil di Tambah');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($author)
    {
        #ambil data buku by Id
        $author = Author::findOrFail($author);
        return view('authors/form-update', [
            'author' => $author,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|unique:authors,name',
        ]);
        $authorId = $request->id;
        $author = Author::findOrFail($authorId);

        $author->update([
            'name' => $request->name,
        ]);
        return redirect(route('authors.index'))->with('Success', 'Data Author Berhasil di Update');
    }

    public function confirmDelete($authorId)
    {
        $author = Author::findOrFail($authorId);
        return view('authors/delete-confirm', [
            'author' => $author,
        ]);
    }

    public function delete(Request $request)
    {
        $authorId = $request->id;
        $author = Author::findOrFail($authorId);
        $author->delete();
        return redirect(route('authors.index'));
    }
}