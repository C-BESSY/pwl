@extends('layout.main')

@section('title', 'Update Buku')

@section('content')

    <!--menggunakan route harus diikuti dengan nama
                                                apabila menggunakan urls harus mengguanakan urls -->
    <!--@if ($errors->any())
                                            <div class="alert alert-danger">
                                                <h5>Terdapat Error pada aplikasi : </h5>
                                                <ul>
                                                    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
                                                </ul>
                                            </div>
                                            @endif--->
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('books.update') }}">
                <!--untuk setiap method post harus menggunakan @csrf -->
                <input type="hidden" name="id" value="{{ $book->id }}">
                @csrf
                <div class="form-group">
                    <label for="">Kode</label>
                    <input class="form-control @error('code') is-invalid @enderror" type="text" value="{{ $book->code }}" name=code />
                    @error('code')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Judul</label>

                    <input class="form-control @error('title') is-invalid @enderror" type="text" value="{{ $book->title }}" name="title" />
                    @error('title')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- <div class="form-group">
                    <label for="">Authors</label>
                    <select class="js-example-basic-multiple form-control @error('id_publisher') is-invalid @enderror" name="id_author[]"
                        multiple="multiple">
                        @foreach ($authors as $a)
                            <option {{ in_array($a->id, $authorArray) ? 'selected' : '' }} value="{{ $a->id }}">{{ $a->name }}</option>
                        @endforeach
                    </select>
                    @error('id_authors')
                        <span class="invalid-feedback"> {{ $message }}</span>
                    @enderror
                </div> --}}

                <p>
                    Publisher : <br>
                    <select class="form-control @error('id_publisher') is-invalid @enderror" name="id_publisher">
                        @foreach ($publishers as $p)
                            <option {{ $p->id == $book->id_publisher ? 'selected' : '' }} value="{{ $p->id }}">
                                {{ $p->name }} </option>
                        @endforeach
                    </select>
                </p>

                <button class="btn btn-secondary" type="button" onclick="location.href='{{ route('books.index') }}'">
                    <i class="fa fa-arrow-circle-left"></i> Kembali
                </button>
                <button class="btn btn-success" type="submit">
                    <i class="fa fa-floppy-o"></i> Ubah
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