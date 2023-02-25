<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Pesanan;
use App\Models\Sablon;
use App\Models\Shop_cart;
use App\Models\Trx_sablon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TrxSablonController extends Controller
{
    public function GetTrxSablon()
    {
        if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'kasir' || Auth::user()->role == 'produksi') {
            $data = Trx_sablon::joinToUser()->joinToSablon()->joinToKurir()->joinToPayment()->get(); //join to table user and table sablon
            $instansi = Instansi::select('logo')->get();
            return view('superadmin.trx_sablon', [
                'title' => 'transaksi sablon',
                'instansi' => $instansi,
                'transaksiSablon' => $data,
            ]);
        } else {
            print("419 page expired");
        }
    }
    public function AddTrxSablon(Request $req)
    {
        // <!-- user_id	sablon_id	kurir_id	payment_id	bdp	bl	jml	pay_status	stts_produksi	trx_status -->
        $req->validate([
            'user_id' => 'required',
            'sablon_id' => 'required',
            'kurir_id' => 'required',
            'payment_id' => 'required',
            'jml' => 'required',
            'tinggalkanpesan' => 'required',
            'tgl_trx' => 'required',
        ]);
        try {
            $datas = new Trx_sablon([
                'user_id' => $req->user_id,
                'sablon_id' => $req->sablon_id,
                'kurir_id' => $req->kurir_id,
                'payment_id' => $req->payment_id,
                'jml' => $req->jml,
                'tinggalkanpesan' => $req->tinggalkanpesan,
                'tgl_trx' => $req->tgl_trx,
            ]);
            // dd($datas);
            $datas->save();
            return redirect('pesanananda')->with('success', 'transaksi sablon berhasil');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('home')->with('message', 'transaksi sablon gagal');
        }
    }
    public function UpdtTrxSablon(Request $req)
    {
        try {
            return redirect('trx_sablon')->with('success', 'transaksi berhasil di update');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('trx_sablon')->with('message', 'transaksi gagal di update');
        }
    }
    public function DeleteTrxSablon($id)
    {
        try {
            return redirect('trx_sablon')->with('success', 'transaksi berhasil di hapus');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('trx_sablon')->with('message', 'transaksi gagal di hapus');
        }
    }

    public function GetPesananAnda()
    {
        if (Auth::user()->role == 'pelanggan') {
            $instansi = Instansi::select('logo', 'whatsapp')->get();
            $isiKeranjang = Shop_cart::where('user_id', '=', Auth::user()->user_id)->get()->count(); //hitung isi keranjang berdasarkan user yang login 
            $dataPesanan = Pesanan::joinToProdukCustom()->joinToWarna()->joinToUser()->joinToKurir()->joinToPayment()->orderBy('pesanan_id', 'desc')->get();
            $pesananSablon = Trx_sablon::joinToUser()->joinToSablon()->joinToKurir()->joinToPayment()->orderBy('trx_sablon_id', 'desc')->get();
            // dd($dataPesanan);
            return view('members.pesananAnda', [
                'title' => 'history transaksi',
                'instansi' => $instansi,
                'pesanansablon' => $pesananSablon,
                'pesananpakaiancustom' => $dataPesanan,
                'isiKeranjang' => $isiKeranjang,
            ]);
        }
    }
}
