@extends('layout.main')

@section('title', 'Hapus publisher')

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('publishers.delete') }}">
                @csrf
                <input type="hidden" value="{{ $publisher->id }}" name="id" />
                <p>
                    publisher : <br>
                    <input type="text" name="publisher" value="{{ $publisher->name }}" disabled />
                </p>

                <button class="btn btn-secondary" type="button" onclick="location.href='{{ route('publishers.index') }}'">
                    <i class="fa fa-arrow-circle-left"></i> Kembali
                </button>
                <button class="btn btn-danger" type="submit">
                    <i class="fa fa-floppy-o"></i> Hapus
                </button>
            </form>
        </div>
    </div>
@endsection