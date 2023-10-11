@extends('layouts.app')
@section('title', 'Berita')

@section('content')
    <h2 class="text-center">
        Update Berita
    </h2>

    {{-- error input --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('berita.update', $berita->slug) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="judul">Judul Berita</label>
            <input type="text" name="judul" id="judul" class="form-control" placeholder="Judul Berita"
                value="{{ $berita->judul }}">
        </div>
        <div class="form-group">
            <label for="isi">Isi Berita</label>
            <textarea name="isi" id="isi" cols="30" rows="10" class="form-control" placeholder="Isi Berita">{{ $berita->isi }}</textarea>
        </div>
        {{-- gambar --}}
        <div class="form-group">
            <label for="gambar">Gambar Berita</label>
            <input type="file" name="gambar[]" multiple id="gambar" class="form-control"
                accept=".jpeg,.png,.jpg,.gif,.svg">
        </div>
        <button type="submit" class="btn btn-primary">Edit Berita</button>
    </form>
@endsection
