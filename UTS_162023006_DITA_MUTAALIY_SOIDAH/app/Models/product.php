<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $fillable = [
        'nama_produk', 
        'kode_produk', 
        'stok_produk', 
        'harga'
    ];

    public function categories()
    {
        return $this->belongsToMany(product::class);
    }
}


