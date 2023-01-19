<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\KategoriProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class KategoriProdukController extends Controller
{
    public function GetKategori()
    {
        $kategori = KategoriProduk::all();
        $data = Instansi::select('logo')->get();
        return view('superadmin.kategoriProduk', [
            'title' => 'kategori produk',
            'kategori' => $kategori,
            'instansi' => $data,
        ]);
    }
    public function Addkategori(Request $request)
    {
        $data = $request->validate([
            'jenis_kategori' => 'required',
            'foto_ktgr' => 'required',
        ]);
        try {
            $fotoKtgr = time() . '.' . $request->foto_ktgr->extension();
            $request->foto_ktgr->move(public_path('foto_ktgr'), $fotoKtgr);
            $data = new KategoriProduk([
                'jenis_kategori' => $request->jenis_kategori,
                'foto_ktgr' => $fotoKtgr,
            ]);
            $data->save();
            return redirect('kategoriProduk')->with('success', 'data berhasil di simapan..!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('instansi')->with('message', 'register gagal');
        }
    }
    public function UpdtKategori(Request $request)
    {
        $data = $request->validate([
            'jenis_kategori' => 'required',
            'foto_ktgr' => 'required',
        ]);
        try {
            $fotoKtgr = time() . '.' . $request->foto_ktgr->extension();
            $request->foto_ktgr->move(public_path('foto_ktgr'), $fotoKtgr);

            $data = array(
                'jenis_kategori' => $request->post('jenis_kategori'),
                'foto_ktgr' => $fotoKtgr,
            );
            KategoriProduk::where('ktgr_id', '=', $request->post('ktgr_id'))->update($data);
            return redirect('kategoriProduk')->with('success', 'data berhasil di update..!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('kategoriProduk')->with('message', 'data gagal di update');
        }
    }
    public function Delete($id)
    {
        KategoriProduk::where('ktgr_id', '=', $id)->delete();
        return redirect('kategoriProduk')->with('message', 'data berhasil di hapus');
    }
}
