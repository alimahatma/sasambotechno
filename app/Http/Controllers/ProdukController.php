<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\KategoriProduk;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProdukController extends Controller
{
    public function GetAllProduk()
    {
        $data = Instansi::select('logo')->get();
        $kategori = KategoriProduk::all();
        $prdk = DB::table('produk')->join('ktgr_produk', 'ktgr_produk.ktgr_id', '=', 'produk.ktgr_id')->get();
        return view('superadmin.produks', [
            'title' => 'all product',
            'produks' => $prdk,
            'instansi' => $data,
            'kategori' => $kategori,
        ]);
    }
    public function AddProduct(Request $request)
    {
        $request->validate([
            'ktgr_id' => 'required',
            'nama_produk' => 'required',
            'foto_prdk' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'satuan' => 'required',
        ]);
        try {
            $fotoProduk = time() . '.' . $request->foto_prdk->extension();
            $request->foto_prdk->move(public_path('foto_produk'), $fotoProduk);
            $data = new Produk([
                'ktgr_id' => $request->ktgr_id,
                'nama_produk' => $request->nama_produk,
                'foto_prdk' => $fotoProduk,
                'deskripsi' => $request->deskripsi,
                'harga' => $request->harga,
                'satuan' => $request->satuan,
            ]);
            $data->save();
            return redirect('produks')->with('success', 'data berhasil di tambahkan..!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('produks')->with('message', 'data gagal di update');
        }
    }
    public function UpdtProduct(Request $request)
    {
        $request->validate([
            'ktgr_id' => 'required',
            'nama_produk' => 'required',
            'foto_prdk' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'satuan' => 'required',
        ]);
        try {
            $fotoProduk = time() . '.' . $request->foto_prdk->extension();
            $request->foto_prdk->move(public_path('foto_produk'), $fotoProduk);
            $data = array(
                'ktgr_id' => $request->post('ktgr_id'),
                'nama_produk' => $request->post('nama_produk'),
                'foto_prdk' => $fotoProduk,
                'deskripsi' => $request->post('deskripsi'),
                'harga' => $request->post('harga'),
                'satuan' => $request->post('satuan'),
            );
            Produk::where('produk_id', '=', $request->post('produk_id'))->update($data);
            return redirect('produks')->with('success', 'data berhasil di update..!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('produks')->with('message', 'data gagal di update');
        }
    }
    public function DeleteProduk($id)
    {
        try {
            Produk::where('produk_id', '=', $id)->delete();
            return redirect('produks')->with('success', 'data berhasil di hapus');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('produks')->with('message', 'data gagal di hapus');
        }
    }
}
