<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_barang';

    protected $fillable = [
        'name',
        'id_kategori',
        'image',
        'stock',
        'price',
        'note',
    ];

    // Relasi dengan Tag
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'barang_tag', 'barang_id', 'tag_id')->withTimestamps();
    }

    // Relasi dengan Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    // Menambahkan accessor untuk gambar agar menjadi URL penuh
    public function getImageUrlAttribute()
    {
        return $this->image ? url('images/' . $this->image) : null;
    }

    // Memastikan atribut ini selalu di-append ke JSON response
    protected $appends = ['image_url'];
}
