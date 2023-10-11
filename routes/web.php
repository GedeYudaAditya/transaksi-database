<?php

use App\Http\Controllers\BeritaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [BeritaController::class, 'index'])->name('berita.index');

Route::get('/berita/detail/{slug}', [BeritaController::class, 'show'])->name('berita.show');

// Tambah Berita
Route::get('/berita/tambah', [BeritaController::class, 'create'])->name('berita.create');
Route::post('/berita/tambah', [BeritaController::class, 'store'])->name('berita.store');

// Edit Berita
Route::get('/berita/edit/{slug}', [BeritaController::class, 'edit'])->name('berita.edit');
Route::post('/berita/edit/{slug}', [BeritaController::class, 'update'])->name('berita.update');

// Hapus Berita
Route::delete('/berita/hapus/{slug}', [BeritaController::class, 'destroy'])->name('berita.destroy');
