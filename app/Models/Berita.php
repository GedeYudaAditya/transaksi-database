<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = ['judul', 'isi', 'slug'];

    public function gambars()
    {
        return $this->hasMany(Gambar::class);
    }
}
