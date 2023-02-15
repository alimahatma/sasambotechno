<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\KategoriProduk;
use App\Models\KtgrProcus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class KtgrProCusController extends Controller
{
    public function GetAll()
    {
        $ktgr = KategoriProduk::all();
        $kategoriProdukCustom = KtgrProcus::joinToKategori()->get();
        $inst = Instansi::select('logo')->get();
        return view('superadmin.ktgrProcus', [
            'title' => 'kategori produk custom',
            'instansi' => $inst,
            'ktgr' => $ktgr,
            'ktgrProcus' => $kategoriProdukCustom,
        ]);
    }
    public function AddKtgrProcus(Request $req)
    {
        $data = $req->validate([
            'ktgr_id' => 'required',
            'jenis_procus' => 'required',
            'foto_procus' => 'required|mimes:png,jpg,jpeg|max:1024',
            'des_ktgrprocus' => 'required',
        ]);
        // dd($data);
        try {
            $fotoKtgrProcus = time() . '.' . $req->foto_procus->extension();
            $req->foto_procus->move(public_path('foto_ktgr'), $fotoKtgrProcus);
            $data = new KtgrProcus([
                'ktgr_id' => $req->ktgr_id,
                'jenis_procus' => $req->jenis_procus,
                'foto_procus' => $fotoKtgrProcus,
                'des_ktgrprocus' => $req->des_ktgrprocus,
            ]);
            $data->save();
            return redirect('kategoriProcus')->with('success', 'data berhasil di tambahkan');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('kategoriProcus')->with('message', 'gagal menambahkan data');
        }
    }
    public function UpdtKtgrProcus(Request $req)
    {
        $data = $req->validate([
            'ktgr_id' => 'required',
            'jenis_procus' => 'required',
            'foto_procus' => 'required|mimes:png,jpg,jpeg|max:1024',
            'des_ktgrprocus' => 'required',
        ]);
        // dd($data);
        try {
            $fotoKtgrProcus = time() . '.' . $req->foto_procus->extension();
            $req->foto_procus->move(public_path('foto_ktgr'), $fotoKtgrProcus);
            $data = array(
                'ktgr_id' => $req->post('ktgr_id'),
                'jenis_procus' => $req->post('jenis_procus'),
                'foto_procus' => $fotoKtgrProcus,
                'des_ktgrprocus' => $req->post('des_ktgrprocus'),
            );
            KtgrProcus::where('ktgr_procus_id', '=', $req->post('ktgr_procus_id'))->update($data);
            return redirect('kategoriProcus')->with('success', 'data berhasil di update');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('kategoriProcus')->with('message', 'gagal update');
        }
    }
    public function DelKtgrProcus($id)
    {
        try {
            KtgrProcus::where('ktgr_procus_id', '=', $id)->delete();
            return redirect('kategoriProcus')->with('success', 'data berhasil di hapus');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('kategoriProcus')->with('message', 'gagal di hapus');
        }
    }
}
