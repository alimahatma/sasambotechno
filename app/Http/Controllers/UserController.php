<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    // get data user return to view admin
    public function GetAlluser()
    {
        if (Auth::user()->role == 'super_admin') {
            $in = Instansi::select('logo')->get();
            $user = User::all();
            return view('superadmin.user', [
                'title' => 'akun user',
                'users' => $user,
                'instansi' => $in
            ]);
        } else {
            print('akses di tolak');
        }
    }

    // get view register
    public function GetRegister()
    {
        $data = Instansi::all();
        return view('auth.register', [
            'title' => 'halaman register',
            'instansi' => $data
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
            // dd($data);
            $data->save();
            return redirect('home')->with('success', 'registrasi berhasil');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('register')->with('message', 'register gagal');
        }
    }

    // funtion for get view login
    public function GetLogin()
    {
        $data = Instansi::all();
        return view('auth.login', [
            'title' => 'halaman login',
            'instansi' => $data
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
                return redirect('index');
            } elseif (Auth::user()->role == 'pengguna') {
                return redirect('home');
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

    // function for change role
    public function ChangeRole(Request $req)
    {
        $req->validate([
            'role' => 'required'
        ]);
        dd($req);
        try {
            $data = array(
                'role' => $req->post('role')
            );
            User::where('user_id', '=', $req->post('user_id'))->update($data);
            return redirect('user')->with('success', 'hak akses berhasil di edit..!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect('user')->with('message', 'register gagal');
        }
    }
    public function Delete($id)
    {
        try {
            User::where('user_id', '=', $id)->delete();
            return redirect('user')->with('success', 'akun berhasil di hapus..!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect('user')->with('message', 'register gagal');
        }
    }
}
