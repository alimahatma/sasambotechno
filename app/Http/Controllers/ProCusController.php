<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\KategoriProduk;
use App\Models\KtgrProcus;
use App\Models\Produk;
use App\Models\ProdukCustom;
use App\Models\Stok;
use App\Models\Supplier;
use App\Models\Warna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProCusController extends Controller
{

    public function GetAllProduk()
    {
        // join for load data stok on form input produk
        $warna = Warna::all();
        $data = Instansi::select('logo')->get();
        $kategori = KategoriProduk::all();
        $ktgr_procus = KtgrProcus::all();
        $supplier = Supplier::all();
        $produkCustom = ProdukCustom::joinKategoriProdukCostum()->joinWarna()->joinToSupplier()->get();
        return view('superadmin.procus', [
            'title' => 'all product',
            'procus' => $produkCustom,
            'instansi' => $data,
            'kategori' => $kategori,
            'ktgrProcus' => $ktgr_procus,
            'warna' => $warna,
            'supplier' => $supplier,
        ]);
    }
    public function AddProduct(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required',
            'ktgr_procus_id' => 'required',
            'warna_id' => 'required',
            'nama_produk' => 'required',
            'foto_dep' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'foto_bel' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'satuan' => 'required',
            'jenis_kain' => 'required',
            'size' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'tgl_masuk' => 'required',
            'deskripsi' => 'required',
        ]);
        try {
            // convert foto depan produk
            $fotoDepan = time() . '.' . $request->foto_dep->extension();
            $request->foto_dep->move(public_path('foto_produk/depan'), $fotoDepan);

            // convert foto belakang produk
            $fotoBelakang = time() . '.' . $request->foto_bel->extension();
            $request->foto_bel->move(public_path('foto_produk/belakang'), $fotoBelakang);
            $data = new ProdukCustom([
                'supplier_id' => $request->supplier_id,
                'ktgr_procus_id' => $request->ktgr_procus_id,
                'warna_id' => $request->warna_id,
                'nama_produk' => $request->nama_produk,
                'foto_dep' => $fotoDepan,
                'foto_bel' => $fotoBelakang,
                'satuan' => $request->satuan,
                'jenis_kain' => $request->jenis_kain,
                'size' => $request->size,
                'harga_beli' => $request->harga_beli,
                'harga_jual' => $request->harga_jual,
                'tgl_masuk' => $request->tgl_masuk,
                'deskripsi' => $request->deskripsi,
            ]);
            $data->save();
            return redirect('procus')->with('success', 'data berhasil di tambahkan..!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('procus')->with('message', 'data gagal di update');
        }
    }
    public function UpdtProduct(Request $request)
    {

        $request->validate([
            'supplier_id' => 'required',
            'ktgr_procus_id' => 'required',
            'warna_id' => 'required',
            'nama_produk' => 'required',
            'foto_dep' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'foto_bel' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'satuan' => 'required',
            'jenis_kain' => 'required',
            'size' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'tgl_masuk' => 'required',
            'deskripsi' => 'required',
        ]);
        try {
            // convert foto depan produk
            $fotoDepan = time() . '.' . $request->foto_dep->extension();
            $request->foto_dep->move(public_path('foto_produk/depan'), $fotoDepan);

            // convert foto belakang produk
            $fotoBelakang = time() . '.' . $request->foto_bel->extension();
            $request->foto_bel->move(public_path('foto_produk/belakang'), $fotoBelakang);
            $data = array(
                'supplier_id' => $request->post('supplier_id'),
                'ktgr_procus_id' => $request->post('ktgr_procus_id'),
                'warna_id' => $request->post('warna_id'),
                'nama_produk' => $request->post('nama_produk'),
                'foto_dep' => $fotoDepan,
                'foto_bel' => $fotoBelakang,
                'satuan' => $request->post('satuan'),
                'jenis_kain' => $request->post('jenis_kain'),
                'size' => $request->post('size'),
                'harga_beli' => $request->post('harga_beli'),
                'harga_jual' => $request->post('harga_jual'),
                'tgl_masuk' => $request->post('tgl_masuk'),
                'deskripsi' => $request->post('deskripsi'),
            );
            ProdukCustom::where('procus_id', '=', $request->post('procus_id'))->update($data);
            return redirect('procus')->with('success', 'data berhasil di update..!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('procus')->with('message', 'data gagal di update');
        }
    }
    public function DeleteProduk($id)
    {
        try {
            ProdukCustom::where('procus_id', '=', $id)->delete();
            return redirect('procus')->with('success', 'data berhasil di hapus');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('procus')->with('message', 'data gagal di hapus');
        }
    }
}
