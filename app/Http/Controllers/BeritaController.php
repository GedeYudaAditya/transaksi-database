<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    //
    public function index()
    {
        $beritas = Berita::latest()->paginate(5);
        return view('berita.index', compact('beritas'));
    }

    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)->first();
        return view('berita.show', compact('berita'));
    }

    public function create()
    {
        return view('berita.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|unique:beritas',
            'isi' => 'required',
            'gambar' => 'required',
            'gambar.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        DB::beginTransaction();

        try {
            $berita = Berita::create([
                'judul' => $request->judul,
                'slug' => Str::slug($request->judul),
                'isi' => $request->isi,
            ]);

            if ($request->hasFile('gambar')) {
                foreach ($request->file('gambar') as $file) {
                    $namaGambar = $file->getClientOriginalName();
                    $file->move(public_path('images'), $namaGambar);
                    $berita->gambars()->create([
                        'nama' => $namaGambar,
                        'path' => '/images/' . $namaGambar,
                    ]);
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return redirect()->back()->with('error', 'Berita gagal ditambahkan');
        }

        return redirect()->route('berita.index', $berita->slug)->with('success', 'Berita berhasil ditambahkan');
    }

    public function edit($slug)
    {
        $berita = Berita::where('slug', $slug)->first();
        return view('berita.edit', compact('berita'));
    }

    public function update(Request $request, $slug)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'gambar' => 'required',
            'gambar.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        DB::beginTransaction();

        try {
            $berita = Berita::where('slug', $slug)->first();
            $berita->update([
                'judul' => $request->judul,
                'slug' => Str::slug($request->judul),
                'isi' => $request->isi,
            ]);

            // check if berita has gambar
            if ($berita->gambars()->exists()) {
                // delete file gambar
                foreach ($berita->gambars as $gambar) {
                    unlink(public_path($gambar->path));
                }

                // delete all gambar
                $berita->gambars()->delete();
            }

            if ($request->hasFile('gambar')) {
                foreach ($request->file('gambar') as $file) {
                    $namaGambar = $file->getClientOriginalName();
                    $file->move(public_path('images'), $namaGambar);
                    $berita->gambars()->create([
                        'nama' => $namaGambar,
                        'path' => '/images/' . $namaGambar,
                    ]);
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Berita gagal diupdate');
        }

        return redirect()->route('berita.index', $berita->slug)->with('success', 'Berita berhasil diupdate');
    }

    public function destroy($slug)
    {
        $berita = Berita::where('slug', $slug)->first();

        DB::beginTransaction();
        try {
            // check if berita has gambar
            if ($berita->gambars()->exists()) {
                // delete file gambar
                foreach ($berita->gambars as $gambar) {
                    unlink(public_path($gambar->path));
                }

                // delete all gambar
                $berita->gambars()->delete();
            }
            $berita->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Berita gagal dihapus');
        }
        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus');
    }
}
