<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Stok;
use App\Models\Warna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StokController extends Controller
{
    public function GetStok()
    {
        $warna = Warna::all();
        $data = DB::table('stok')->join('warna', 'warna.warna_id', '=', 'stok.warna_id')->get();
        $instansi = Instansi::select('logo')->get();
        return view('superadmin.stok', [
            'title' => 'Data stok',
            'instansi' => $instansi,
            'stok' => $data,
            'warna' => $warna,
        ]);
    }
    public function AddStok(Request $req)
    {
        $val = $req->validate([
            'warna_id' => 'required',
            'jumlah' => 'required',
            'jenis_kain' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'tgl_masuk' => 'required',
        ]);
        //dd($val); //warna_id	jumlah	jenis_kain	harga_beli	harga_jual	tgl_masuk
        try {
            $data = new Stok([
                'warna_id' => $req->warna_id,
                'jumlah' => $req->jumlah,
                'jenis_kain' => $req->jenis_kain,
                'harga_beli' => $req->harga_beli,
                'harga_jual' => $req->harga_jual,
                'tgl_masuk' => $req->tgl_masuk,
            ]);
            $data->save();
            return redirect('stok')->with('success', 'data berhasil di tambah');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('stok')->with('message', 'gagal');
        }
    }
    public function UpdtStok(Request $req)
    {
        $req->validate([
            'warna_id' => 'required',
            'jumlah' => 'required',
            'jenis_kain' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'tgl_masuk' => 'required',
        ]);
        try {
            $data = array(
                'warna_id' => $req->post('warna_id'),
                'jumlah' => $req->post('jumlah'),
                'jenis_kain' => $req->post('jenis_kain'),
                'harga_beli' => $req->post('harga_beli'),
                'harga_jual' => $req->post('harga_jual'),
                'tgl_masuk' => $req->post('tgl_masuk'),
            );
            Stok::where('stok_id', '=', $req->post('stok_id'))->update($data);
            return redirect('stok')->with('success', 'data berhasil di edit');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('user')->with('message', 'gagal');
        }
    }
    public function DeleteStok($id)
    {
        try {
            Stok::where('stok_id', '=', $id)->delete();
            return redirect('stok')->with('success', 'data berhasil di hapus');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('user')->with('message', 'gagal');
        }
    }
}
