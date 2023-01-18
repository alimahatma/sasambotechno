<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class InstansiController extends Controller
{
    public function GetInstansi()
    {
        $data = Instansi::all();
        return view('superadmin.instansi', [
            'title' => 'perusahaan',
            'instansi' => $data,
        ]);
    }
    public function AddInstansi(Request $req)
    {
        $req->validate([
            'nama_instansi' => 'required',
            'logo' => 'required|image|mimes:png,jpg,jpeg|max:1024',
            'visi' => 'required',
            'misi' => 'required',
            'tentang' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'facebook' => 'required',
            'instagram' => 'required',
            'whatsapp' => 'required',
            'telepon' => 'required',
            'github' => 'required',
        ]);
        // dd($req);
        try {
            $logoName = time() . '.' . $req->logo->extension();
            $req->logo->move(public_path('logo'), $logoName);
            $data = new Instansi([
                'nama_instansi' => $req->nama_instansi,
                'logo' => $logoName,
                'visi' => $req->visi,
                'misi' => $req->misi,
                'tentang' => $req->tentang,
                'alamat' => $req->alamat,
                'email' => $req->email,
                'facebook' => $req->facebook,
                'instagram' => $req->instagram,
                'whatsapp' => $req->whatsapp,
                'telepon' => $req->telepon,
                'github' => $req->github,
            ]);
            $data->save();
            return redirect('instansi')->with('success', 'data berhasil di tambahkan');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('instansi')->with('message', 'register gagal');
        }
    }
    public function UpdtInstansi(Request $req)
    {
        $req->validate([
            'nama_instansi' => 'required',
            'logo' => 'required',
            'visi' => 'required',
            'misi' => 'required',
            'alamat' => 'required',
            'facebook' => 'required',
            'instagram' => 'required',
            'whatsapp' => 'required',
            'telepon' => 'required',
            'github' => 'required',
        ]);
        try {
            $data = array(
                'nama_instansi' => $req->post('nama_instansi'),
                'logo' => $req->post('logo'),
                'visi' => $req->post('visi'),
                'misi' => $req->post('misi'),
                'alamat' => $req->post('alamat'),
                'facebook' => $req->post('facebook'),
                'instagram' => $req->post('instagram'),
                'whatsapp' => $req->post('whatsapp'),
                'telepon' => $req->post('telepon'),
                'github' => $req->post('github'),
            );
            Instansi::where('inst_id', '=', $req->inst_id)->update();
            return redirect('instansi')->with('success', 'data berhasil di update');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('instansi')->with('message', 'register gagal');
        }
    }
    public function Delete($id)
    {
        Instansi::where('inst_id', '=', $id)->delete();
        return redirect('instansi')->with('success', 'data berhasil di hapus..!');
    }
}
