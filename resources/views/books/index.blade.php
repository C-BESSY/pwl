@extends('layout.main')

@section('title', 'Data Buku')
    
@section('content')
    <body>
        <h1>Daftar Buku</h1>
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Alert!</h5>
            {{ $message }}
        </div>
        @endif
        <a class="btn btn-primary mb-2" href="{{ route('books.create') }}">Tambah Buku</a>
        <table border="1" width='100%'>
            <thead>
                <tr>
                    <td>No</td>
                    <td>Kode</td>
                    <td>Judul</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @forelse ($books as $book)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $book->code }}</td>
                        <td>{{ $book->title }}</td>
                        <td>
                            <a class="btn btn-dark btn-sm" href="{{ route('books.edit', [$book->id]) }}" >
                                <i class="fa fa-pencil-alt"></i>
                            </a>
                            <a class="btn btn-danger btn-sm" href="{{ route('books.del.confirm', [$book->id]) }}" >
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td style="text-align:center" colspan="4"><b>Data Kosong </b></td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </body>
@endsection
