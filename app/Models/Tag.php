<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_tag';   
    protected $fillable = ['name'];

    // Relasi dengan Barang
    public function barangs()
    {
        return $this->belongsToMany(Barang::class, 'barang_tag', 'tag_id', 'barang_id');
    }
}
