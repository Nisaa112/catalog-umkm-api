<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = [
        'title',
        'id_kategori',
        'id_umkm',
        'rating',
        'price',
        'description',
        'images',
    ];

    public function kategori()
    {
        return $this->belongsTo(kategori::class, 'id_kategori');
    }

    public function umkm()
    {
        return $this->belongsTo(umkm::class, 'id_umkm');
    }
}
