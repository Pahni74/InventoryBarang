<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
class SiteController extends Controller
{
    public function home(){
        // return view('sites.home');
        return view('auth.login');
    }
    public function register(){
        return view('sites.register');
    }

    public function postregister(Request $request){
        //Input Pendaftar Sebagai User Terlebih Dahulu
        // $this->validate($request, [
        //     'name' => 'required|min:4',
        //     'email' => 'required|min:4|email|unique:users',
        //     'password' => 'required',
        //     'confirmation' => 'required|same:password',
        // ]);

        // $data = new \App\User;
        // $data->name = $request->name;
        // $data->email = $request->email;
        // $data->password = bcrypt($request->password);
        // $data->save();
        // $request->request->add(['user_id' => $user->id]);
        // return redirect('login')->with('alert-success','Kamu berhasil Register');

        $user = new \App\User;
        $user->role = 'user';
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt ($request->password);
        $user->remember_token = str_random(60);
        $user->save();
        $request->request->add(['user_id' => $user->id]);
        return redirect('/login')->with('sukses','Data Pendaftaran Berhasil Di Kirim');
    }
}
