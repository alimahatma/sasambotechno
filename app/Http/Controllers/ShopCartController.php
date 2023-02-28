<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Pesanan;
use App\Models\Shop_cart;
use App\Models\Trx_sablon;
use App\Models\Warna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class ShopCartController extends Controller
{
    public function GetDataCart()
    {
        $instansi = Instansi::select('logo')->get();
        $isiKeranjang = Shop_cart::where('user_id', '=', Auth::user()->user_id)->get()->count(); //hitung isi keranjang berdasarkan user yang login 
        $shopCartProduk = Shop_cart::joinProcus()->joinToWarna()->joinTableSablon()->get();
        // $shopCartSablon = Shop_cart::joinTableSablon()->get();
        // dd($shopCartProduk);
        return view('members.mycart', [
            'title' => 'keranjang saya',
            'instansi' => $instansi,
            'shopcartproduk' => $shopCartProduk,
            // 'shopcartsablon' => $shopCartSablon,
            'isiKeranjang' => $isiKeranjang,
        ]);
    }

    //funcsi untuk menambahkan produk custom ke keranjang
    public function AddToCart(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'procus_id' => 'required',
            'jumlah_order' => 'required',
            'harga_satuan' => 'required',
            'harga_totals' => 'required',
        ]);
        try {
            $tombolcart = new Shop_cart([
                'user_id' => $request->user_id,
                'procus_id' => $request->procus_id,
                // 'ktgr_procus_id' => $request->ktgr_procus_id,
                'warna_id' => $request->warna_id,
                'jumlah_order' => $request->jumlah_order,
                'harga_satuan' => $request->harga_satuan,
                'harga_totals' => $request->harga_totals,
            ]);
            // dd($tombolcart);
            $tombolcart->save();
            // return Redirect::back()->with('success', 'gagal menambahkan ke keranjang');
            return redirect('/home')->with('success', 'berhasil menambahkan ke keranjang');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('/home')->with('errors', 'gagal menambahkan ke keranjang');
            // return redirect('details/{id}')->with('errors', 'gagal menambahkan ke keranjang');
        }
    }

    //funcsi untuk menambahkan sablon ke keranjang
    public function AddSablonToCart(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'sablon_id' => 'required',
            'jumlah_order' => 'required',
        ]);
        try {
            $tombolcart = new Shop_cart([
                'user_id' => $request->user_id,
                'sablon_id' => $request->sablon_id,
                'jumlah_order' => $request->jumlah_order,
            ]);
            // dd($tombolcart);
            $tombolcart->save();
            // return Redirect::back()->with('success', 'gagal menambahkan ke keranjang');
            return redirect('/home')->with('success', 'berhasil menambahkan ke keranjang');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('/home')->with('errors', 'gagal menambahkan ke keranjang');
            // return redirect('details/{id}')->with('errors', 'gagal menambahkan ke keranjang');
        }
    }

    public function DelBarangOnKeranjang($id)
    {
        try {
            Shop_cart::where('cart_id', '=', $id)->delete();
            return redirect('/cart')->with('success', 'berhasil menghapus barang dari keranjang');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('/cart')->with('errors', 'gagal menghapus barang dari keranjang');
        }
    }
    public function TrxSablon(Request $request)
    {
        $request->validate([
            'sablon_id' => 'required',
            'payment_id' => 'required',
            'kurir_id' => 'required',
            'jumlah_order' => 'required',
            'tinggalkanpesan' => 'required',
        ]);
        try {
            $trxSablon = new Trx_sablon([
                'sablon_id' => $request->sablon_id,
                'payment_id' => $request->payment_id,
                'kurir_id' => $request->kurir_id,
                'jumlah_order' => $request->jumlah_order,
                'tinggalkanpesan' => $request->tinggalkanpesan,
            ]);
            $trxSablon->save();
            return redirect('/pesanananda')->with('success', 'transaksi berhasil');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('/cart')->with('errors', 'transaksi gagal..!');
        }
    }
    public function TrxPakaiancustom(Request $request)
    {
        $request->validate([
            'procus_id' => 'required',
            'payment_id' => 'required',
            'kurir_id' => 'required',
            'jumlah_order' => 'required',
            'tinggalkanpesan' => 'required',
        ]);
        try {
            $trxSablon = new Pesanan([
                'procus_id' => $request->procus_id,
                'payment_id' => $request->payment_id,
                'kurir_id' => $request->kurir_id,
                'jml_order' => $request->jumlah_order,
                't_pesan' => $request->tinggalkanpesan,
            ]);
            $trxSablon->save();
            return redirect('/pesanananda')->with('success', 'transaksi berhasil');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('/cart')->with('errors', 'transaksi gagal..!');
        }
    }
    public function AllTrx()
    {
        // jika transaksi masih dalam satu fungsi maka pakaitransaction
        // DB::transaction(function(){
        // $this->TrxSablon();
        // $this->TrxPakaiancustom();
        // });

        DB::beginTransaction();
        try {
            $this->TrxSablon();
            $this->TrxPakaiancustom();

            DB::commit();
            return redirect('/pesanananda')->with('success', 'transaksi berhasil');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
        }
        // jika transaksi menggunakan fungsi yang berbeda maka gunakan begin transaction

    }
}
