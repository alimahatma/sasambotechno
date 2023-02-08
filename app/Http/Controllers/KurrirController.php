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
            'nama_jakir' => 'required',
            'jenis_jakir' => 'required',
        ]);
        try {
            $data = new Kurir([
                'nama_jakir' => $req->nama_jakir,
                'jenis_jakir' => $req->jenis_jakir,
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
            'nama_jakir' => 'required',
            'jenis_jakir' => 'required',
        ]);
        try {
            $data = array(
                'nama_jakir' => $req->post('nama_jakir'),
                'jenis_jakir' => $req->post('jenis_jakir')
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
