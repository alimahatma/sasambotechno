<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MemberController extends Controller
{
    public function GetMember()
    {
        $user = User::all();
        // dd($user);
        $instansi = Instansi::select('logo')->get();
        $data = DB::table('member')->join('users', 'users.user_id', '=', 'member.user_id')->get();
        return view('superadmin.member', [
            'title' => 'Data member',
            'instansi' => $instansi,
            'member' => $data,
            'user' => $user,
        ]);
    }
    public function AddMember(Request $req)
    {
        $val = $req->validate([
            'user_id' => 'required',
            'nama_lengkap' => 'required',
            'telepon' => 'required',
            'gender' => 'required',
            'desa' => 'required',
            'kecamatan' => 'required',
            'kabupaten' => 'required',
            'provinsi' => 'required',
        ]);
        //dd($val); //user_id_id	nama_lengkap	telepon	gender	desa	kecamatan
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
            return redirect('member')->with('success', 'data berhasil di tambah');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('member')->with('message', 'gagal');
        }
    }
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
