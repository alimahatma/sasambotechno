<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Warna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WarnaController extends Controller
{

    public function GetWarna()
    {
        $data = Warna::all();
        $instansi = Instansi::select('logo')->get();
        return view('superadmin.warna', [
            'title' => 'Data warna',
            'instansi' => $instansi,
            'warna' => $data,
        ]);
    }
    public function AddWarna(Request $req)
    {
        $req->validate([
            'nama_warna' => 'required',
        ]);
        try {
            $data = new Warna([
                'nama_warna' => $req->nama_warna,
            ]);
            $data->save();
            return redirect('warna')->with('success', 'berhasil di tambah');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('warna')->with('message', 'gagal');
        }
    }
    public function UpdtWarna(Request $req)
    {
        $req->validate([
            'nama_warna' => 'required',
        ]);
        try {
            $data = array(
                'nama_warna' => $req->post('nama_warna'),
            );
            Warna::where('warna_id', '=', $req->post('warna_id'))->update($data);
            return redirect('warna')->with('success', 'berhasil di update');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('warna')->with('message', 'gagal');
        }
    }
    public function DeleteWarna($id)
    {
        try {
            Warna::where('warna_id', '=', $id)->delete();
            return redirect('warna')->with('success', 'berhasil di hapus');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('warna')->with('message', 'gagal');
        }
    }
}
