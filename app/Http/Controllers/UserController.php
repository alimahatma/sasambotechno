<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Shop_cart;
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
        if (Auth::user()->role == 'superadmin') {
            $in = Instansi::select('logo')->get();
            $user = User::all();
            return view('superadmin.user', [
                'title' => 'akun user',
                'users' => $user,
                'instansi' => $in
            ]);
        } elseif (Auth::user()->role == 'pelanggan') {

            $isiKeranjang = Shop_cart::where('user_id', '=', Auth::user()->user_id)->get()->count(); //hitung isi keranjang berdasarkan user yang login
            $instansi = Instansi::select('logo')->get();
            $user = User::all();
            return view('members.profile', [
                'title' => 'akun user',
                'users' => $user,
                'instansi' => $instansi,
                'isiKeranjang' => $isiKeranjang,
            ]);
        } else {
            print('akses di tolak');
        }
    }

    // register user di lakukan oleh super admin
    public function AddUser(Request $req)
    {
        try {
            $req->validate([
                'name' => 'required',
                'email' => 'required|unique:users',
                'password' => 'required|min:6',
                'role' => 'required'
            ]);
            $data = new User([
                'name' => $req->name,
                'email' => $req->email,
                'password' => Hash::make('password'),
                'role' => $req->role,
            ]);
            $data->save();
            // dd($data);
            return redirect('user')->with('success', 'register berhasil');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('user')->with('errors', 'register gagal');
        }
    }
    // get data user with json
    // public function GetAll()
    // {
    //     $user = User::all();
    //     return response()->json([
    //         'users' => $user
    //     ]);
    // }

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
                'password' => Hash::make('password')
                // 'password' => $req->password
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
            if (Auth::user()->role == 'superadmin') {
                return redirect('dashboard');
            } elseif (Auth::user()->role == 'kasir') {
                return redirect('index');
            } elseif (Auth::user()->role == 'produksi') {
                return redirect('pesanan');
            } elseif (Auth::user()->role == 'pelanggan') {
                return redirect('home');
            } else {
                print("anda tidak memiliki hak akses");
            }
        }
        return back()->withErrors(['message', 'email atau password salah']);
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


    // update data user oleh pelanggan
    public function UpdtUser(Request $req)
    {
        $req->validate([
            'nama_lengkap' => 'required',
            'telepon' => 'required',
            'gender' => 'required',
            'desa' => 'required',
            'kecamatan' => 'required',
            'kabupaten' => 'required',
            'provinsi' => 'required',
        ]);
        try {
            $data = array(
                'nama_lengkap' => $req->post('nama_lengkap'),
                'telepon' => $req->post('telepon'),
                'gender' => $req->post('gender'),
                'desa' => $req->post('desa'),
                'kecamatan' => $req->post('kecamatan'),
                'kabupaten' => $req->post('kabupaten'),
                'provinsi' => $req->post('provinsi'),
            );
            User::where('user_id', '=', $req->post('user_id'))->update($data);
            return redirect('profile')->with('success', 'data berhasil di edit');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('profile')->with('message', 'gagal');
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

    // form lengkapi akun pelanggan
    public function GetForm()
    {
        $instansi = Instansi::select('logo')->get();
        $isiKeranjang = Shop_cart::where('user_id', '=', Auth::user()->user_id)->get()->count(); //hitung isi keranjang berdasarkan user yang login
        return view('members.getFormProfile', [
            'title' => 'lengkapi akun',
            'instansi' => $instansi,
            'isiKeranjang' => $isiKeranjang,
        ]);
    }
}
