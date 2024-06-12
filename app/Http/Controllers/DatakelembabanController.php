<?php

namespace App\Http\Controllers;

use App\Models\Datakelembaban;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DatakelembabanController extends Controller
{
    function datakelembabanview_owner()
    {
        // Ambil data dari MySQL
        $dataKelembaban = Datakelembaban::all();

        return view('owner.datakelembaban', compact('dataKelembaban'));
    }

    function datakelembabanview_kepalakandang()
    {
        // Ambil data dari MySQL
        $dataKelembaban = Datakelembaban::all();

        return view('kepalakandang.datakelembaban', compact('dataKelembaban'));
    }

    public function sensordata(Request $request)
    {

        $kelembaban = $request->input('kelembaban');

        if ($kelembaban !== null) {
            $sensorData = new Datakelembaban();
            $sensorData->kelembaban = $kelembaban;
            if ($kelembaban >= 20) {
                $sensorData->status = 'Sudah Diganti'; // Atau nilai status yang sesuai
            } else {
                $sensorData->status = 'Belum Diganti'; // Atau nilai status yang sesuai
            }
            $sensorData->save();

            return response()->json(['message' => 'Data tersimpan dengan sukses'], 200);
        } else {
            return response()->json(['message' => 'Gagal menyimpan data: Nilai kelembaban tidak boleh null'], 400);
        }
    }

    public function speedometer()
    {
        $kelembabanterbaru = Datakelembaban::latest()->value('kelembaban'); // Misalnya, mendapatkan kelembaban terbaru dari database
        return response()->json(['kelembabanterbaru' => $kelembabanterbaru]);
    }

    function tabelawal()
    {
        $datatabel = Datakelembaban::latest()->take(12)->get();
        return response()->json(['datatabel' => $datatabel]);
    }


    function datatabel()
    {
        $datatabel = Datakelembaban::all();
        return response()->json(['datatabel' => $datatabel]);
    }
}
