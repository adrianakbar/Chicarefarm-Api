<?php

namespace App\Http\Controllers;

use App\Models\Datakaryawan;
use App\Models\Hari;
use App\Models\Listtugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListtugasController extends Controller
{
    function listtugasview_owner()
    {
        $user = Auth::user();
        $hariDenganTugas = Listtugas::join('hari', 'listtugas.id_hari', '=', 'hari.id_hari')
            ->select('listtugas.*', 'hari.nama_hari')
            ->get();
        $hari = Hari::pluck('nama_hari');
        return view('owner.listtugas', compact('user', 'hariDenganTugas', 'hari'));
    }

    function listtugasview_kepalakandang()
    {
        $user = Auth::user();
        $hariDenganTugas = Listtugas::join('hari', 'listtugas.id_hari', '=', 'hari.id_hari')
            ->select('listtugas.*', 'hari.nama_hari')
            ->get();
        return view('kepalakandang.listtugas', compact('user', 'hariDenganTugas'));
    }

    public function updateCheckbox(Request $request)
    {
        $task = Listtugas::find($request->id_tugas); // Replace with your model
        if ($task) {
            $task->checkbox = $request->checkbox;
            $task->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }

    // public function createdata(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'judul' => 'required',
    //         'deskripsi' => 'required',
    //         'hari' => 'required', // validate the day field
    //         'checkbox' => 'required',
    //     ]);

    //     // Find the day by name, assuming you have a model for it
    //     $hari = Hari::where('nama_hari', $validatedData['hari'])->first();

    //     // Create a new task and associate it with the found day
    //     $tugas = new Listtugas();
    //     $tugas->judul = $validatedData['judul'];
    //     $tugas->deskripsi = $validatedData['deskripsi'];
    //     $tugas->checkbox = $validatedData['checkbox'];
    //     $tugas->id_hari = $hari->id_hari; // assuming the day model has an 'id' field
    //     $tugas->save();

    //     return response()->json(['success' => 'Tugas berhasil dibuat.']);
    // }

    // public function deletedata($id_tugas)
    // {
    //     // Cari data berdasarkan ID
    //     $tugas = Listtugas::findOrFail($id_tugas);

    //     // Hapus data
    //     $tugas->delete();

    //     // Beri respon sukses
    //     return response()->json(['message' => 'Data berhasil dihapus']);
    // }

}
