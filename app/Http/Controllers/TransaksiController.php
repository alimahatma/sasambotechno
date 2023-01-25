<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TransaksiController extends Controller
{
    public function GetTransaksi()
    {
        $instansi = Instansi::select('logo')->get();

        $data = DB::table('transaksi')
            ->join('member', 'member.member_id', '=', 'transaksi.member_id')
            ->join('produk', 'produk.produk_id', '=', 'transaksi.produk_id')
            ->join('ktgr_produk', 'ktgr_produk.ktgr_id', '=', 'produk.ktgr_id')
            ->join('stok', 'stok.stok_id', '=', 'produk.stok_id')
            ->join('warna', 'warna.warna_id', '=', 'stok.warna_id')
            ->join('supplier', 'supplier.supplier_id', '=', 'produk.supplier_id')
            ->get();
        // dd($data);
        return view('superadmin.transaksi', [
            'title' => 'Data transaksi',
            'instansi' => $instansi,
            'transaksi' => $data,
        ]);
    }
    public function AddTransaction(Request $req)
    {
        $req->validate([
            'member_id' => 'required',
            'produk_id' => 'required',
            'tanggal_transaksi' => 'required',
        ]);
        try {
            $transaksi = new Transaksi([
                'member_id' => $req->member_id,
                'produk_id' => $req->produk_id,
                'sablon_id' => $req->sablon_id,
                'tanggal_transaksi' => $req->tanggal_transaksi
            ]);
            $transaksi->save();
            return redirect('transaksi')->with('success', 'transaksi berhasil');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('transaksi')->with('message', 'transaksi gagal');
        }
    }
    public function UpdtTransaction(Request $req)
    {
        $req->validate([
            'member_id' => 'required',
            'produk_id' => 'required',
            'tanggal_transaksi' => 'required',
        ]);
        try {
            $updt = array(
                'member_id' => $req->post('member_id'),
                'produk_id' => $req->post('produk_id'),
                'sablon_id' => $req->post('sablon_id'),
                'tanggal_transaksi' => $req->post('tanggal_transaksi')
            );
            Transaksi::where('transaksi_id', '=', $req->post('transaksi_id'))->update($updt);
            return redirect('transaksi')->with('success', 'transaksi berhasil di update');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('transaksi')->with('message', 'transaksi gagal di update');
        }
    }
    public function DeleteTransaction($id)
    {
        try {
            Transaksi::where('transaksi_id', '=', $id)->delete;
            return redirect('transaksi')->with('success', 'transaksi berhasil di hapus');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('transaksi')->with('message', 'transaksi gagal di hapus');
        }
    }
}
