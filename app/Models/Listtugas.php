<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listtugas extends Model
{
    use HasFactory;

    protected $table = 'listtugas';
    protected $primaryKey = 'id_tugas';

    protected $fillable = [
        'judul',
        'deskripsi',
        'checkbox',
        'id_hari',  // Pastikan menambahkan kolom foreign key
    ];

    // Jika Anda ingin menonaktifkan timestamp
    public $timestamps = false;

    // Definisikan relasi ke model Hari
    public function hari()
    {
        return $this->belongsTo(Hari::class, 'id_hari');
    }
}
