@extends('layouts.app')

@section('title', 'Berita')
<h2 class="text-center">List Berita</h2>

@section('content')
    <a href="{{ route('berita.create') }}" class="btn btn-primary mb-2">Tambah Berita</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Isi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($beritas as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->judul }}</td>
                    <td>{{ $item->isi }}</td>
                    <td>
                        <a href="{{ route('berita.edit', $item->slug) }}" class="btn btn-warning">Edit</a>
                        {{-- detil --}}
                        <a href="{{ route('berita.show', $item->slug) }}" class="btn btn-info">Detil</a>
                        {{-- hapus --}}
                        <form action="{{ route('berita.destroy', $item->slug) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger"
                                onclick="return confirm('Yakin ingin menghapus data?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
