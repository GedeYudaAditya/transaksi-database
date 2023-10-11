<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gambar extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'path', 'berita_id'];

    public function berita()
    {
        return $this->belongsTo(Berita::class);
    }
}
