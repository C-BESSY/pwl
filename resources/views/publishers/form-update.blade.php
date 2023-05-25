@extends('layout.main')

@section('title', 'Update publisher')

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('publishers.update') }}">
                <input type="hidden" name="id" value="{{ $publisher->id }}">
                @csrf
                <div class="form-group">
                    <label for="">Nama</label>
                    <input class="form-control @error('name') is-invalid @enderror" value="{{ $publisher->name }}" type="text" name="name" />
                    @error('name')
                        <span class="invalid-feedback"> {{ $message }}</span>
                    @enderror
                </div>
                <button class="btn btn-secondary" type="button" onclick="location.href='{{ route('publishers.index') }}'">
                    <i class="fa fa-arrow-circle-left"></i> Kembali
                </button>
                <button class="btn btn-success" type="submit">
                    <i class="fa fa-floppy-o"></i> Ubah
                </button>
            </form>
        </div>
    </div>
@endsection