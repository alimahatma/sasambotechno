<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\KategoriProduk;
use App\Models\KtgrProsoft;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class KtgrProSoftController extends Controller
{
    public function GetAll()
    {
        $ktgr = KategoriProduk::all();
        // $ktgrSoftware = DB::table('ktgr_prdk_software')->join('ktgr_produk', 'ktgr_produk.ktgr_id', '=', 'ktgr_prdk_software.ktgr_id')->get();
        $ktgrSoftware = DB::table('ktgr_prdk_software')->join('ktgr_produk', 'ktgr_produk.ktgr_id', '=', 'ktgr_prdk_software.ktgr_id')->get();
        $inst = Instansi::select('logo')->get();
        return view('superadmin.ktgrProsoft', [
            'title' => 'kategori produk custom',
            'instansi' => $inst,
            'ktgr' => $ktgr,
            'ktgrprosoft' => $ktgrSoftware,
        ]);
    }
    //ktgr_id	jenis_prosoft	foto_prosoft	des_ktgrprosoft	
    public function AddKtgrProsoft(Request $req)
    {
        $data = $req->validate([
            'ktgr_id' => 'required',
            'jenis_prosoft' => 'required',
            'foto_prosoft' => 'required|mimes:png,jpg,jpeg|max:1024',
            'des_ktgrprosoft' => 'required',
        ]);
        // dd($data);
        try {
            $fotoKtgrProsoft = time() . '.' . $req->foto_prosoft->extension();
            $req->foto_prosoft->move(public_path('foto_ktgr'), $fotoKtgrProsoft);
            $data = new KtgrProsoft([
                'ktgr_id' => $req->ktgr_id,
                'jenis_prosoft' => $req->jenis_prosoft,
                'foto_prosoft' => $fotoKtgrProsoft,
                'des_ktgrprosoft' => $req->des_ktgrprosoft,
            ]);
            $data->save();
            return redirect('kategoriProsoft')->with('success', 'data berhasil di tambahkan');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('kategoriProsoft')->with('message', 'gagal menambahkan data');
        }
    }
    public function UpdtKtgrProsoft(Request $req)
    {
        $data = $req->validate([
            'ktgr_id' => 'required',
            'jenis_prosoft' => 'required',
            'foto_prosoft' => 'required|mimes:png,jpg,jpeg|max:1024',
            'des_ktgrprosoft' => 'required',
        ]);
        // dd($data);
        try {
            $fotoKtgrProsoft = time() . '.' . $req->foto_prosoft->extension();
            $req->foto_prosoft->move(public_path('foto_ktgr'), $fotoKtgrProsoft);
            $data = array(
                'ktgr_id' => $req->post('ktgr_id'),
                'jenis_prosoft' => $req->post('jenis_prosoft'),
                'foto_prosoft' => $fotoKtgrProsoft,
                'des_ktgrprosoft' => $req->post('des_ktgrprosoft'),
            );
            KtgrProsoft::where('ktgr_prosoft_id', '=', $req->post('ktgr_prosoft_id'))->update($data);
            return redirect('kategoriProsoft')->with('success', 'data berhasil di update');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('kategoriProsoft')->with('message', 'gagal update');
        }
    }
    public function DelKtgrProsoft($id)
    {
        try {
            KtgrProsoft::where('ktgr_prosoft_id', '=', $id)->delete();
            return redirect('kategoriProsoft')->with('success', 'data berhasil di hapus');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('kategoriProsoft')->with('message', 'gagal di hapus');
        }
    }
}
