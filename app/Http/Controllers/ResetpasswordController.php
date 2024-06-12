<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetpasswordController extends Controller
{
    public function reset(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Jika user tidak ditemukan
        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'Email tidak terdaftar']);
        }

        // Periksa apakah password yang dimasukkan sama dengan yang ada di database
        if (Hash::check($request->password, $user->password)) {
            return redirect()->back()->withErrors(['password' => 'Masukkan password yang baru']);
        }

        // Reset password
        $user->password = Hash::make($request->password);
        $user->save();

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Password berhasil direset');
    }
}
