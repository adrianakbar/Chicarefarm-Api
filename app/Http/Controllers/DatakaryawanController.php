<?php

namespace App\Http\Controllers;

use App\Models\Datakaryawan;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DatakaryawanController extends Controller
{
    function datakaryawanview_owner()
    {
        $client = new Client();
        $response = $client->request('GET', 'http://localhost:8000/api/datakaryawan');
        $content = json_decode($response->getBody()->getContents());
        $karyawan = $content->data; // Menggunakan notasi panah untuk objek
        return view('owner.datakaryawan', compact('karyawan'));
    }


    function datakaryawanview_kepalakandang()
    {
        $client = new Client();
        $response = $client->request('GET', 'http://localhost:8000/api/datakaryawan');
        $content = json_decode($response->getBody()->getContents());
        $karyawan = $content->data; // Menggunakan notasi panah untuk objek
        return view('kepalakandang.datakaryawan', compact('karyawan'));
    }

    function getidkaryawan($id_karyawan)
    {
        $karyawan = Datakaryawan::findOrFail($id_karyawan);
        return response()->json($karyawan);
    }

    // function updatedata(Request $request, $id_karyawan)
    // {
    //     $karyawan = Datakaryawan::findOrFail($id_karyawan);
    //     $karyawan->nama_karyawan = $request->input('nama');
    //     $karyawan->tanggal_masuk = $request->input('tanggalMasuk');
    //     $karyawan->alamat = $request->input('alamat');
    //     $karyawan->no_hp = $request->input('noHp');
    //     $karyawan->save();
    // }


    // function createdata(Request $request)
    // {
    //     $nama_karyawan = $request->nama;
    //     $tanggal_masuk = $request->tanggal_masuk;
    //     $alamat = $request->alamat;
    //     $no_hp = $request->no_hp;

    //     $parameter = [
    //         'nama_karyawan' => $nama_karyawan,
    //         'tanggal_masuk' => $tanggal_masuk,
    //         'alamat' => $alamat,
    //         'no_hp' => $no_hp
    //     ];

    //     $client = new Client();
    //     $response = $client->request('POST', 'http://localhost:8000/api/datakaryawan', [
    //         'headers' => ['Content-Type' => 'application/json'],
    //         'body' => json_encode($parameter)
    //     ]);
    //     $content = json_decode($response->getBody()->getContents());
    //     $karyawan = $content->data; // Menggunakan notasi panah untuk objek
    // }

    // function deletedata($id_karyawan)
    // {
    //     // Lakukan operasi delete data berdasarkan ID yang diterima
    //     // Contoh:
    //     $karyawan = Datakaryawan::findOrFail($id_karyawan);
    //     $karyawan->delete();
    // }
}
