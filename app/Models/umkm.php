<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class umkm extends Model
{
    use HasFactory;

    protected $table = 'umkm';

    protected $fillable = [
        'umkm_name',
        'owner_name',
        'umkm_desc',
        'phone',
        'email',
        'address',
        'images',
    ];

    public function produk()
    {
        return $this->hasMany(produk::class);
    }

}
