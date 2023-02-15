<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MemberController extends Controller
{
    // get all data member
    public function GetMember()
    {
        if (Auth::user()->role == 'superadmin') {
            $user = User::all();
            $instansi = Instansi::select('logo')->get();
            $dataMember = Member::joinMemberToUser()->get();
            return view('superadmin.member', [
                'title' => 'Data member',
                'instansi' => $instansi,
                'member' => $dataMember,
                'user' => $user,
            ]);
        } elseif (Auth::user()->role == 'pelanggan') {
            $user = User::all();
            $instansi = Instansi::select('logo')->get();
            $dataMember = Member::joinMemberToUser()->get();
            return view('members.addProfile', [
                'title' => 'profile',
                'instansi' => $instansi,
                'member' => $dataMember,
                'users' => $user,
            ]);
        }
    }

    // add member
    public function AddMember(Request $req)
    {
        $req->validate([
            'user_id' => 'required',
            'nama_lengkap' => 'required',
            'telepon' => 'required',
            'gender' => 'required',
            'desa' => 'required',
            'kecamatan' => 'required',
            'kabupaten' => 'required',
            'provinsi' => 'required',
        ]);
        try {
            $data = new Member([
                'user_id' => $req->user_id,
                'nama_lengkap' => $req->nama_lengkap,
                'telepon' => $req->telepon,
                'gender' => $req->gender,
                'desa' => $req->desa,
                'kecamatan' => $req->kecamatan,
                'kabupaten' => $req->kabupaten,
                'provinsi' => $req->provinsi,
            ]);
            // dd($data);
            $data->save();
            if (Auth::user()->role == 'superadmin') {
                return redirect('member')->with('success', 'data berhasil di tambah');
            } elseif (Auth::user()->role == 'pelanggan') {
                return redirect('profile')->with('success', 'profile berhasil di simpan');
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('member')->with('message', 'gagal');
        }
    }

    // update data member
    public function UpdtMember(Request $req)
    {
        $req->validate([
            'user_id' => 'required',
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
                'user_id' => $req->post('user_id'),
                'nama_lengkap' => $req->post('nama_lengkap'),
                'telepon' => $req->post('telepon'),
                'gender' => $req->post('gender'),
                'desa' => $req->post('desa'),
                'kecamatan' => $req->post('kecamatan'),
                'kabupaten' => $req->post('kabupaten'),
                'provinsi' => $req->post('provinsi'),
            );
            Member::where('member_id', '=', $req->post('member_id'))->update($data);
            return redirect('member')->with('success', 'data berhasil di edit');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('member')->with('message', 'gagal');
        }
    }

    //delete data member 
    public function DeleteMember($id)
    {
        try {
            Member::where('member_id', '=', $id)->delete();
            return redirect('member')->with('success', 'data berhasil di hapus');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('member')->with('message', 'gagal');
        }
    }
}
