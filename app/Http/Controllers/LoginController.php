<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function lupapasswordview() {
        return view('login.lupapassword');
    }

    function logout() {
        Auth::logout();
        return redirect('');
    }
}
