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
        return $this->belongsToMany(Tag::class, 'barang_tag', 'barang_id', 'tag_id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }
}
