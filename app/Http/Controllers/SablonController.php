<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Sablon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SablonController extends Controller
{
    public function GetSablon()
    {
        $data = Sablon::all();
        $instansi = Instansi::select('logo')->get();
        return view('superadmin.sablon', [
            'title' => 'Data Sablon',
            'instansi' => $instansi,
            'sablon' => $data,
        ]);
    }
    public function AddSablon(Request $req)
    {
        $req->validate([
            'ukuran_sablon' => 'required',
            'harga' => 'required',
        ]);
        try {
            $data = new Sablon([
                'ukuran_sablon' => $req->ukuran_sablon,
                'harga' => $req->harga,
            ]);
            $data->save();
            return redirect('sablon')->with('success', 'berhasil di tambah');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('sablon')->with('message', 'gagal');
        }
    }
    public function UpdtSablon(Request $req)
    {
        $req->validate([
            'ukuran_sablon' => 'required',
            'harga' => 'required',
        ]);
        try {
            $data = array(
                'ukuran_sablon' => $req->post('ukuran_sablon'),
                'harga' => $req->post('harga')
            );
            Sablon::where('sablon_id', '=', $req->post('sablon_id'))->update($data);
            return redirect('sablon')->with('success', 'berhasil di update');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('sablon')->with('message', 'gagal');
        }
    }
    public function DeleteSablon($id)
    {
        try {
            Sablon::where('sablon_id', '=', $id)->delete();
            return redirect('sablon')->with('success', 'berhasil di hapus');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('sablon')->with('message', 'gagal');
        }
    }
}
