<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Datakaryawan;
use Illuminate\Http\Request;

class DatakaryawanController extends Controller
{
    function index(){
        $data = Datakaryawan::orderBy('nama_karyawan', 'asc')->get();
        return response()->json([
            'status' => 'success', // menampilkan status response
            'message' => 'Berhasil menampilkan data karyawan',
            'data' => $data
        ]);
    }

    function show($id_karyawan){
        $data = Datakaryawan::find($id_karyawan);
        if($data){
            return response()->json([
                'status' => 'success',
                'message' => 'Data karyawan berhasil ditemukan',
                'data' => $data
            ]);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Data karyawan tidak ditemukan',
            ]);
        }
    }

    function store(Request $request){
        // Validasi data yang diterima
        $request->validate([
            'nama_karyawan' => 'required',
            'tanggal_masuk' => 'required|date',
            'alamat' => 'required',
            'no_hp' => 'required'
        ]);

        // Simpan data karyawan ke dalam database
        $karyawan = new Datakaryawan();
        $karyawan->nama_karyawan = $request->nama_karyawan;
        $karyawan->tanggal_masuk = $request->tanggal_masuk;
        $karyawan->alamat = $request->alamat;
        $karyawan->no_hp = $request->no_hp;
        $karyawan->save();

        if($karyawan){
            return response()->json([
                'status' => 'success',
                'message' => 'Data karyawan berhasil ditambahkan',
                'data' => $karyawan
            ]);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Data karyawan gagal ditambahkan',
            ]);
        }
    }

    function update(Request $request, $id_karyawan){
        // Validasi data yang diterima
        $request->validate([
            'nama_karyawan' => 'required',
            'tanggal_masuk' => 'required|date',
            'alamat' => 'required',
            'no_hp' => 'required'
        ]);

        // Cari data karyawan berdasarkan id
        $karyawan = Datakaryawan::find($id_karyawan);

        if($karyawan){
            // Update data karyawan
            $karyawan->nama_karyawan = $request->nama_karyawan;
            $karyawan->tanggal_masuk = $request->tanggal_masuk;
            $karyawan->alamat = $request->alamat;
            $karyawan->no_hp = $request->no_hp;
            $karyawan->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Data karyawan berhasil diupdate',
                'data' => $karyawan
            ]);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Data karyawan tidak ditemukan',
            ]);
        }
    }

    function destroy($id_karyawan){
        // Cari data karyawan berdasarkan id
        $karyawan = Datakaryawan::find($id_karyawan);

        if($karyawan){
            // Hapus data karyawan
            $karyawan->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Data karyawan berhasil dihapus',
            ]);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Data karyawan tidak ditemukan',
            ]);
        }
    }
}
