@extends('layout.main')

@section('title', 'Tambah Buku')

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('books.store') }}">
                @csrf
                <div class="form-group">
                    <label for="">Kode</label>
                    <input type="text" class="form-control" name="code" required>
                </div>
                <div class="form-group">
                    <label for="">Judul</label>
                    <input type="text" class="form-control" name="title" required>
                </div>
                <button class="btn btn-succes" type="submit">
                    <i class="fa fa-save"></i> Simpan
                </button>
            </form>
        </div>
    </div>
@endsection
