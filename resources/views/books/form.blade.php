@extends('layout.main')

@section('title', 'Tambah Buku')

@section('content')
    @if ($errors->any())
        <h1>ERROR!</h1>
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('books.store') }}">
                @csrf
                <div class="form-group">
                    <label for="">Kode</label>
                    <input type="text" class="form-control @error('code') is-invalid @enderror" value="{{ old('code') }}"
                        type="text" name="code" />
                    @error('code')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Judul</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" value="{{ old('code') }}" 
                        type="text" name="title" />
                    @error('title')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <button class="btn btn-success" type="submit">
                    <i class="fa fa-save"></i> Simpan
                </button>
            </form>
        </div>
    </div>
@endsection
