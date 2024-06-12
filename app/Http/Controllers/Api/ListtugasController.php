<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hari;
use App\Models\Listtugas;
use Illuminate\Http\Request;

class ListtugasController extends Controller
{
    function index(){
        $data = Listtugas::orderBy('id_hari', 'asc')->get();
        return response()->json([
            'status' => 'success', // menampilkan status response
            'message' => 'Berhasil menampilkan tugas', // menampilkan pesan
            'data' => $data
        ]);
    }

    function show($id_tugas){
        $data = Listtugas::find($id_tugas);
        if($data){
            return response()->json([
                'status' => 'success',
                'message' => 'Tugas berhasil ditemukan',
                'data' => $data
            ]);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Tugas tidak ditemukan',
            ]);
        }
    }

    function store(Request $request){

        $validatedData = $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'hari' => 'required', // validate the day field
            'checkbox' => 'required',
        ]);

        // Find the day by name, assuming you have a model for it
        $hari = Hari::where('nama_hari', $validatedData['hari'])->first();

        // Create a new task and associate it with the found day
        $tugas = new Listtugas();
        $tugas->judul = $validatedData['judul'];
        $tugas->deskripsi = $validatedData['deskripsi'];
        $tugas->checkbox = $validatedData['checkbox'];
        $tugas->id_hari = $hari->id_hari; // assuming the day model has an 'id' field
        $tugas->save();

        if($tugas){
            return response()->json([
                'status' => 'success',
                'message' => 'Tugas berhasil ditambahkan',
                'data' => $tugas
            ]);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Tugas gagal ditambahkan',
            ]);
        }
    }

    function destroy($id_tugas){
        // Cari data karyawan berdasarkan id
        $tugas = Listtugas::find($id_tugas);

        if($tugas){
            // Hapus data karyawan
            $tugas->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Tugas berhasil dihapus',
            ]);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Tugas tidak ditemukan',
            ]);
        }
    }

    public function updateCheckbox(Request $request)
    {
        $task = Listtugas::find($request->id_tugas); // Replace with your model
        if ($task) {
            $task->checkbox = $request->checkbox;
            $task->save();
            return response()->json([
                'status' => 'success',
                'message' => 'Checkbox berhasil diupdate',
                'data' => $task
            ]);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Tugas tidak ditemukan',
            ]);
        }
    }
}
