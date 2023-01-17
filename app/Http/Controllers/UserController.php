<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    //construct for activate verivied email
    public function __construct()
    {
        // $this->middleware(['auth', 'verified']);
    }

    // get data user return to view admin
    public function GetAlluser()
    {
        $user = User::all();
        return view('superadmin.user', [
            'title' => 'akun user',
            'users' => $user
        ]);
    }

    // get view register
    public function GetRegister()
    {
        return view('auth.register', [
            'title' => 'halaman register'
        ]);
    }

    // function for send data register to database
    public function PostRegister(Request $req)
    {
        $req->validate([
            'name' => 'required|max:25',
            'email' => 'required|unique:users',
            'password' => 'required|min:6'
        ]);
        try {
            $data = new User([
                'name' => $req->name,
                'email' => $req->email,
                'password' => Hash::make($req->password),
            ]);
            $data->save();
            return redirect('login')->with('success', 'registrasi berhasil');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('register')->with('message', 'register gagal');
        }
    }

    // funtion for get view login
    public function GetLogin()
    {
        return view('auth.login', [
            'title' => 'halaman login'
        ]);
    }

    // funtion for authentication login user email
    public function AuthLogin(Request $req)
    {
        $req->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        if (Auth::attempt($req->only('email', 'password'))) {
            if (Auth::user()->role == 'super_admin') {
                return redirect('user');
            } elseif (Auth::user()->role == 'admin') {
                return redirect('user');
            } elseif (Auth::user()->role == 'pengguna') {
                return redirect('user');
            } else {
                print("anda tidak memiliki hak akses");
            }
        }
        return back()->withErrors(['password', 'email atau password salah']);
    }

    // funtion for logout
    public function Logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/');
    }
}
