<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publishers = Publisher::query()
            ->when(request('search'), function ($query) {
                $searchTerm = '%' . request('search') . '%';
                $query->where('name', 'like', $searchTerm);
            })->paginate(10);
        return view('publishers/index', [
            'publishers' => $publishers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('publishers/form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|unique:publishers,name',
        ]);

        $name = $request->name;
        Publisher::create([
            'name' => $name,
        ]);

        return redirect(route('publishers.index'))->with('Success', 'Publisher Berhasil di Tambah');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($publisher)
    {
        #ambil data buku by Id
        $publisher = Publisher::findOrFail($publisher);
        return view('publishers/form-update', [
            'publisher' => $publisher,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|unique:publishers,name',
        ]);
        $publisherId = $request->id;
        $publisher = Publisher::findOrFail($publisherId);

        $publisher->update([
            'name' => $request->name,
        ]);
        return redirect(route('publishers.index'))->with('Success', 'Data Publisher Berhasil di Update');
    }

    public function confirmDelete($publisherId)
    {
        $publisher = Publisher::findOrFail($publisherId);
        return view('publishers/delete-confirm', [
            'publisher' => $publisher,
        ]);
    }

    public function delete(Request $request)
    {
        $publisherId = $request->id;
        $publisher = Publisher::findOrFail($publisherId);
        $publisher->delete();
        return redirect(route('publishers.index'));
    }
}