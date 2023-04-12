<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Kurir;
use App\Models\Payment;
use App\Models\Pesanan;
use App\Models\Shop_cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class ShopCartController extends Controller
{
    // fungsi untuk menampilkan semua data yang ada di keranjang
    public function GetDataCart()
    {
        $instansi = Instansi::select('logo')->get();
        $isiKeranjang = Shop_cart::where('user_id', '=', Auth::user()->user_id)->get()->count(); //hitung isi keranjang berdasarkan user yang login 
        $shopCartProduk = Shop_cart::joinProcus()->joinToWarna()->joinTableSablon()->orderBy('cart_id', 'desc')->get();
        $kurir = Kurir::all();
        $payment = Payment::all();
        return view('members.mycart', [
            'title' => 'keranjang saya',
            'instansi' => $instansi,
            'shopcartproduk' => $shopCartProduk,
            'kurir' => $kurir,
            'payment' => $payment,
            'isiKeranjang' => $isiKeranjang,
        ]);
    }

    //funcsi untuk menambahkan produk custom ke keranjang
    public function AddToCart(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'procus_id' => 'required',
            'size_order' => 'required',
            'jumlah_order' => 'required',
            'harga_satuan' => 'required',
            'harga_totals' => 'required',
        ]);
        // dd($request);
        try {
            $tombolcart = new Shop_cart([
                'user_id' => $request->user_id,
                'procus_id' => $request->procus_id,
                'size_order' => $request->size_order,
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

    //fungsi untuk menambahkan sablon ke keranjang
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

    // fungsi untuk menghapus satu barang dari keranjang belanja
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

    // fungsi untuk checkout satu pakaian custom dari keranjang
    public function TrxPakaiancustom(Request $request)
    {
        if ($request->procus_id == true) {
            $request->validate([
                'procus_id' => 'required',
                'user_id' => 'required',
                'kurir_id' => 'required',
                'payment_id' => 'required',
                'size_orders' => 'required',
                'jml_order' => 'required',
                't_pesan' => 'required',
            ]);
            try {
                DB::beginTransaction();
                $data = new Pesanan([
                    'procus_id' => $request->procus_id,
                    'user_id' => $request->user_id,
                    'kurir_id' => $request->kurir_id,
                    'payment_id' => $request->payment_id,
                    'size_orders' => $request->size_orders,
                    'jml_order' => $request->jml_order,
                    't_pesan' => $request->t_pesan,
                    'tgl_order' => $request->tgl_order,
                ]);
                // dd($data);
                $data->save();
                Shop_cart::where('cart_id', '=', $request->cart_id)->delete();
                DB::commit();
                return redirect('pesanananda')->with('success', 'transaksi berhasil');
            } catch (\Exception $e) {
                Log::error($e->getMessage());
                DB::rollBack();
                return redirect('cart')->with('errors', 'transaksi gagal..!');
            }
        }
        if ($request->sablon_id == true) {
            $request->validate([
                'sablon_id' => 'required',
                'user_id' => 'required',
                'kurir_id' => 'required',
                'payment_id' => 'required',
                'jml_order' => 'required',
                't_pesan' => 'required',
            ]);
            try {
                DB::beginTransaction();
                $data = new Pesanan([
                    'sablon_id' => $request->sablon_id,
                    'user_id' => $request->user_id,
                    'kurir_id' => $request->kurir_id,
                    'payment_id' => $request->payment_id,
                    'jml_order' => $request->jml_order,
                    't_pesan' => $request->t_pesan,
                    'tgl_order' => $request->tgl_order,
                ]);
                // dd($data);
                $data->save();
                Shop_cart::where('cart_id', '=', $request->cart_id)->delete();
                DB::commit();
                return redirect('pesanananda')->with('success', 'transaksi berhasil');
            } catch (\Exception $e) {
                Log::error($e->getMessage());
                DB::rollBack();
                return redirect('cart')->with('errors', 'transaksi gagal..!');
            }
        }
    }

    public function AllTrx()
    {
        // jika transaksi masih dalam satu fungsi maka pakaitransaction
        // DB::transaction(function(){
        // $this->TrxSablon();
        // $this->TrxPakaiancustom();
        // });

        // DB::beginTransaction();
        // try {
        //     $this->TrxSablon();
        //     $this->TrxPakaiancustom();

        //     DB::commit();
        //     return redirect('/pesanananda')->with('success', 'transaksi berhasil');
        // } catch (\Exception $e) {
        //     Log::error($e->getMessage());
        //     DB::rollback();
        // }
        // jika transaksi menggunakan fungsi yang berbeda maka gunakan begin transaction

    }
}
