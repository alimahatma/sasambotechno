<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Kurir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class KurrirController extends Controller
{
    public function GetKurir()
    {
        $data = Kurir::all();
        $instansi = Instansi::select('logo')->get();
        return view('superadmin.kurir', [
            'title' => 'Data kurir',
            'instansi' => $instansi,
            'kurir' => $data,
        ]);
    }
    public function AddKurir(Request $req)
    {
        $req->validate([
            'nama_kurir' => 'required',
            'jenis_kurir' => 'required',
        ]);
        try {
            $data = new Kurir([
                'nama_kurir' => $req->nama_kurir,
                'jenis_kurir' => $req->jenis_kurir,
            ]);
            $data->save();
            return redirect('kurir')->with('success', 'berhasil di tambah');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('kurir')->with('message', 'gagal');
        }
    }
    public function UpdtKurir(Request $req)
    {
        $req->validate([
            'nama_kurir' => 'required',
            'jenis_kurir' => 'required',
        ]);
        try {
            $data = array(
                'nama_kurir' => $req->post('nama_kurir'),
                'jenis_kurir' => $req->post('jenis_kurir')
            );
            Kurir::where('kurir_id', '=', $req->post('kurir_id'))->update($data);
            return redirect('kurir')->with('success', 'berhasil di update');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('kurir')->with('message', 'gagal');
        }
    }
    public function DeleteKurir($id)
    {
        try {
            Kurir::where('kurir_id', '=', $id)->delete();
            return redirect('kurir')->with('success', 'berhasil di hapus');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('kurir')->with('message', 'gagal');
        }
    }
}
