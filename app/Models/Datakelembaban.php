<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datakelembaban extends Model
{
    protected $table = 'datakelembaban';

    protected $fillable = [
        'kelembaban',
        'date',
        'status',
    ];

    // Jika Anda ingin menonaktifkan timestamp
    public $timestamps = false;
}
