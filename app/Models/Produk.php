<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk1';
    protected $primaryKey = 'idproduk';
    public $incrementing = false; // Menonaktifkan auto increment
    protected $keyType = 'int'; // Tipe data primary key
    
    protected $fillable = [
        'idproduk', 'namaproduk', 'stokproduk', 'hargaproduk'
    ];
    public $timestamps = false; // Tambahkan ini untuk menonaktifkan timestamps otomatis
}

