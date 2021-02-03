<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
class UserController extends Controller
{
    public function home(){
        // return view('sites.home');
        return view('auth.login');
    }

    public function index(){
        if(!Session::get('login')){
            return redirect('login')->with('alert','Kamu harus login dulu');
        }
        else{
            return view('beranda');
        }
    }

    public function login(){
        return view('/login');
    }

    public function loginPost(Request $request){

        $email = $request->email;
        $password = $request->password;

        $data = ModelUser::where('email',$email)->first();
        if($data){ //apakah email tersebut ada atau tidak
            if(Hash::check($password,$data->password)){
                Session::put('name',$data->name);
                Session::put('email',$data->email);
                Session::put('login',TRUE);
                return redirect('beranda');
            }
            else{
                return redirect('/login')->with('gagal','Email Atau Password Salah!');
            }
        }
        else{
            return redirect('/login')->with('gagal','Email Atau Password Salah!');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/login')->with('sukses','Kamu Sudah Logout');
    }

    public function register(Request $request){
        return view('sites.register');
    }

    public function postregister(Request $request){
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|min:4|email|unique:users',
            'password' => 'required',
            'confirmation' => 'required|same:password',
        ]);

        $data = new \App\User;
        $data->name = $request->name;
        $data->role = 'user';
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->save();
        return redirect('login')->with('alert-success','Kamu berhasil Register');
    }
}
