<?php

namespace App\Http\Controllers;

use App\Models\Datakelembaban;
use Illuminate\Http\Request;

class SpeedometerController extends Controller
{
    public function speedometer()
    {
        $kelembabanterbaru = Datakelembaban::latest()->value('kelembaban'); // Misalnya, mendapatkan kelembaban terbaru dari database
        return response()->json(['kelembaban' => $kelembabanterbaru]);
    }
}
