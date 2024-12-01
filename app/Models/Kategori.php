<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_kategori';
    protected $table = 'kategoris';
    protected $guarded = ['id_kategori'];

    protected $fillable = [
        'nama',
    ];

    // Relasi ke tabel Barang (one-to-many)
    public function barang()
    {
        return $this->hasMany(Barang::class, 'id_kategori', 'id_kategori'); // id_kategori di tabel kategoris, id_kategori di tabel barangs
    }
}
