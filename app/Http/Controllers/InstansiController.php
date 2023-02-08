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
        $datas = Instansi::all();
        $data = Instansi::select('logo')->get();
        return view('superadmin.instansi', [
            'title' => 'perusahaan',
            'instansi' => $data,
            'instansis' => $datas,
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
            'domain' => 'required',
            'email' => 'required|email|unique:instansi',
            'whatsapp' => 'required',
            'instagram' => 'required',
            'facebook' => 'required',
            'billing' => 'required',
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
                'domain' => $req->domain,
                'email' => $req->email,
                'whatsapp' => $req->whatsapp,
                'instagram' => $req->instagram,
                'facebook' => $req->facebook,
                'billing' => $req->billing,
            ]);
            $data->save();
            return redirect('instansi')->with('success', 'data berhasil di tambahkan');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('instansi')->with('errors', 'gagal');
        }
    }
    public function UpdtInstansi(Request $req)
    {
        $req->validate([
            'nama_instansi' => 'required',
            'logo' => 'required|image|mimes:png,jpg,jpeg|max:1024',
            'visi' => 'required',
            'misi' => 'required',
            'tentang' => 'required',
            'alamat' => 'required',
            'domain' => 'required',
            'email' => 'required',
            'whatsapp' => 'required',
            'instagram' => 'required',
            'facebook' => 'required',
            'billing' => 'required',
        ]);
        // dd($req);
        try {
            $logoName = time() . '.' . $req->logo->extension();
            $req->logo->move(public_path('logo'), $logoName);
            $data = array(
                'nama_instansi' => $req->post('nama_instansi'),
                'logo' => $logoName,
                'visi' => $req->post('visi'),
                'misi' => $req->post('misi'),
                'tentang' => $req->post('tentang'),
                'alamat' => $req->post('alamat'),
                'domain' => $req->post('domain'),
                'email' => $req->post('email'),
                'whatsapp' => $req->post('whatsapp'),
                'instagram' => $req->post('instagram'),
                'facebook' => $req->post('facebook'),
                'billing' => $req->post('billing'),
            );
            Instansi::where('inst_id', '=', $req->post('inst_id'))->update($data);
            return redirect('instansi')->with('success', 'data berhasil di update');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('instansi')->with('message', 'gagal');
        }
    }
    public function Delete($id)
    {
        Instansi::where('inst_id', '=', $id)->delete();
        return redirect('instansi')->with('success', 'data berhasil di hapus..!');
    }
}
