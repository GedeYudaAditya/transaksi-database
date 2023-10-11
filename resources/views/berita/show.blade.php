@extends('layouts.app')
@section('title', 'Berita')

@section('content')
    <h2 class="text-center">
        Detil Berita
    </h2>

    {{-- judul --}}
    <h3>Judul : {{ $berita->judul }}</h3>
    {{-- isi --}}
    <p>Isi : {{ $berita->isi }}</p>
    {{-- gambar --}}
    <div class="row">
        @foreach ($berita->gambars as $item)
            <div class="col-md-4">
                <img src="{{ asset($item->path) }}" alt="" class="img-fluid">
            </div>
        @endforeach
    </div>
    {{-- kembali --}}
    <a href="{{ route('berita.index') }}" class="btn btn-primary">Kembali</a>
@endsection
