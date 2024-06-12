<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hari extends Model
{
    use HasFactory;

    protected $table = 'hari';

    protected $fillable = [
        'hari',
    ];

    // Jika Anda ingin menonaktifkan timestamp
    public $timestamps = false;

    // Definisikan relasi ke model Listtugas
    public function listtugas()
    {
        return $this->hasMany(Listtugas::class, 'id_hari');
    }
}
