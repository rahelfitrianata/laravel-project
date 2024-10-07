<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Jika tabelnya bernama 'roles' sesuai konvensi Laravel, tidak perlu menuliskan properti ini
    protected $table = 'roles';

    // Jika tabel menggunakan primary key dengan nama selain 'id', gunakan ini:
    protected $primaryKey = 'id';

    // Jika primary key bukan auto increment, tambahkan ini:
    public $incrementing = true;

    // Jika primary key bukan tipe integer, tambahkan ini:
    protected $keyType = 'int';

    // Jika Anda ingin menghindari pengisian otomatis kolom created_at dan updated_at
    public $timestamps = true;

    // Daftar atribut yang bisa diisi secara massal
    protected $fillable = [
        'name', // misalnya, atribut 'name' untuk menyimpan nama peran
        'description', // misalnya, atribut 'description' untuk menyimpan deskripsi peran
    ];

    // Jika ada relasi, misalnya role memiliki banyak pengguna, tambahkan:
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
