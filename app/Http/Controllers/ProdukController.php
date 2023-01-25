<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\KategoriProduk;
use App\Models\Produk;
use App\Models\Stok;
use App\Models\Supplier;
use App\Models\Warna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProdukController extends Controller
{
    public function GetAllProduk()
    {
        // join for load data stok on form input produk
        Warna::all();
        $stok = DB::table('stok')->join('warna', 'warna.warna_id', '=', 'stok.warna_id')->get();
        // dd($stok);
        $data = Instansi::select('logo')->get();
        $kategori = KategoriProduk::all();
        $supplier = Supplier::all();
        $prdk = DB::table('produk')
            ->join('ktgr_produk', 'ktgr_produk.ktgr_id', '=', 'produk.ktgr_id')
            ->join('stok', 'stok.stok_id', '=', 'produk.stok_id')
            ->join('warna', 'warna.warna_id', '=', 'stok.warna_id')
            ->join('supplier', 'supplier.supplier_id', '=', 'produk.supplier_id')
            ->get();
        // dd($prdk);
        return view('superadmin.produks', [
            'title' => 'all product',
            'produks' => $prdk,
            'instansi' => $data,
            'kategori' => $kategori,
            'supplier' => $supplier,
            'stok' => $stok,
        ]);
    }
    public function AddProduct(Request $request)
    {
        $request->validate([
            'ktgr_id' => 'required',
            'stok_id' => 'required',
            'supplier_id' => 'required',
            'nama_produk' => 'required',
            'foto_dep' => 'required',
            'foto_bel' => 'required',
            'deskripsi' => 'required',
            'satuan' => 'required',
            'size' => 'required'
        ]);
        try {
            // convert foto depan produk
            $fotoDepan = time() . '.' . $request->foto_dep->extension();
            $request->foto_dep->move(public_path('foto_produk'), $fotoDepan);

            // convert foto belakang produk
            $fotoBelakang = time() . '.' . $request->foto_bel->extension();
            $request->foto_bel->move(public_path('foto_produk'), $fotoBelakang);
            $data = new Produk([
                'ktgr_id' => $request->ktgr_id,
                'stok_id' => $request->stok_id,
                'supplier_id' => $request->supplier_id,
                'nama_produk' => $request->nama_produk,
                'foto_dep' => $fotoDepan,
                'foto_bel' => $fotoBelakang,
                'deskripsi' => $request->deskripsi,
                'satuan' => $request->satuan,
                'size' => $request->size,
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
            'stok_id' => 'required',
            'supplier_id' => 'required',
            'nama_produk' => 'required',
            'foto_dep' => 'required',
            'foto_bel' => 'required',
            'deskripsi' => 'required',
            'satuan' => 'required',
            'size' => 'required'
        ]);
        try {
            // convert foto depan produk
            $fotoDepan = time() . '.' . $request->foto_dep->extension();
            $request->foto_dep->move(public_path('foto_produk'), $fotoDepan);

            // convert foto belakang produk
            $fotoBelakang = time() . '.' . $request->foto_bel->extension();
            $request->foto_bel->move(public_path('foto_produk'), $fotoBelakang);
            $data = array(
                'ktgr_id' => $request->post('ktgr_id'),
                'stok_id' => $request->post('stok_id'),
                'supplier_id' => $request->post('supplier_id'),
                'nama_produk' => $request->post('nama_produk'),
                'foto_dep' => $fotoDepan,
                'foto_bel' => $fotoBelakang,
                'deskripsi' => $request->post('deskripsi'),
                'satuan' => $request->post('satuan'),
                'size' => $request->post('size'),
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
