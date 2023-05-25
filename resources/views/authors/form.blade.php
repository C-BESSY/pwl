@extends('layout.main')

@section('title', 'Tambah Buku')

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('books.store') }}">
                @csrf
                <div class="form-group">
                    <label for="">Nama Author</label>
                    <input class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" type="text" name="name" />
                    @error('name')
                        <span class="invalid-feedback"> {{ $message }}</span>
                    @enderror
                </div>
                

                <button class="btn btn-success" type="submit">
                    <i class="fa fa-save"></i>Simpan
                </button>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endsection