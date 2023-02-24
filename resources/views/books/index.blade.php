<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Buku</title>
</head>
<body>
    <h1>Daftar Buku</h1>
    @if ($message = Session::get('success'))
    {{message}}
    @endif
    <a href="{{route('books.create')}}">Tambah Buku</a>
    <table border="1" width='500'>
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
                <td>{{$no++}}</td>
                <td>{{$book->code}}</td>
                <td>{{$book->title}}</td>
                <td></td>
            </tr>
            @empty
            <tr>
                <td style="text-align:center" colspan="4"><b>Data Kosong </b></td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>