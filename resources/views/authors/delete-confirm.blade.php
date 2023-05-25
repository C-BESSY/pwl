@extends('layout.main')

@section('title', 'Hapus Author')

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('authors.delete') }}">
                @csrf
                <input type="hidden" value="{{ $author->id }}" name="id" />
                <p>
                    Author : <br>
                    <input type="text" name="author" value="{{ $author->name }}" disabled />
                </p>

                <button class="btn btn-secondary" type="button" onclick="location.href='{{ route('authors.index') }}'">
                    <i class="fa fa-arrow-circle-left"></i> Kembali
                </button>
                <button class="btn btn-danger" type="submit">
                    <i class="fa fa-floppy-o"></i> Hapus
                </button>
            </form>
        </div>
    </div>
@endsection