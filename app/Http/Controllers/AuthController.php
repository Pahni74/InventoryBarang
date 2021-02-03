<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
class AuthController extends Controller
{
    public function login(){

        return view('auth.login');
    }

    public function postlogin(Request $request)
    {
        if(Auth::attempt($request->only('email','password'))){
            \Session::flash('sukses','Anda Berhasil Login');
            return redirect('/beranda');
        }
        \Session::flash('gagal','Email Atau Password Salah');
        return redirect('/login');
    }

    public function logout(){
        Auth::logout();
        Session::flush();
        return redirect('/login')->with('sukses','Kamu Sudah Logout');
    }
}
