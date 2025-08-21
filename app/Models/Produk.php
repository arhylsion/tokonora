<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'harga', 'stok', 'deskripsi', 'image'];

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

}
