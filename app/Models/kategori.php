<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';

    protected $fillable = [
        'category'
    ];

    public function produk()
    {
        return $this->hasMany(produk::class);
    }
}
