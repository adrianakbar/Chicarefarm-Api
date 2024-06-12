<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datakaryawan extends Model
{
    use HasFactory;

    protected $table = 'datakaryawan';

    protected $primaryKey = 'id_karyawan';
    protected $fillable = [
        'nama_karyawan',
        'tanggal_masuk',
        'alamat',
        'no_hp',
    ];

    public $timestamps = false;
}
