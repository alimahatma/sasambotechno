<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\KtgrProcus;
use App\Models\Kurir;
use App\Models\Payment;
use App\Models\ProdukCustom;
use App\Models\Sablon;
use App\Models\Shop_cart;
use App\Models\User;
use App\Models\Warna;
use Illuminate\Support\Facades\Auth;

class RoleMemberController extends Controller
{
    public function GetHome()
    {
        $isiKeranjang = Shop_cart::where('user_id', '=', Auth::user()->user_id)->get()->count(); //hitung isi keranjang berdasarkan user yang login 'isiKeranjang' => $isiKeranjang,
        $procategori = KtgrProcus::joinToKategori()->get();
        $produkCustom = ProdukCustom::joinKategoriProdukCostum()->get();
        // $testing = ProdukCustom::joinKategoriProdukCostum()->orderBy('ktgr_procus_id', 'desc')->paginate(1);
        // dd($testing);
        $instansi = Instansi::all();
        $sablon = Sablon::all();
        $payment = Payment::all();
        $kurir = Kurir::all();
        return view('members.home', [
            'title' => 'home',
            'instansi' => $instansi,
            'kategoricustom' => $procategori,
            'produk_custom' => $produkCustom,
            'sablon' => $sablon,
            'payment' => $payment,
            'kurir' => $kurir,
            // 'testing' => $testing,
            'isiKeranjang' => $isiKeranjang,
        ]);
    }

    public function GetInvoice()
    {
        $data = Instansi::all();
        $isiKeranjang = Shop_cart::where('user_id', '=', Auth::user()->user_id)->get()->count();
        return view('members.yourInvoice', [
            'title' => 'histori invoice anda',
            'instansi' => $data,
            'isiKeranjang' => $isiKeranjang,
        ]);
    }
    public function GetProfile()
    {
        $isiKeranjang = Shop_cart::where('user_id', '=', Auth::user()->user_id)->get()->count();
        $data = Instansi::select('logo')->get();
        $users = User::all();
        return view('members.profile', [
            'title' => 'profile anda',
            'instansi' => $data,
            'users' => $users,
            'isiKeranjang' => $isiKeranjang,
        ]);
    }

    // detail custom sebelum login
    public function DetailCustom($id)
    {
        $data = Instansi::all();
        // $isiKeranjang = Shop_cart::where('user_id', '=', Auth::user()->user_id)->get()->count(); //hitung isi keranjang berdasarkan user yang login 'isiKeranjang' => $isiKeranjang,
        $procus = ProdukCustom::joinKategoriProdukCostum()->get();
        $prdkGroup = ProdukCustom::select('produk_custom.nama_produk')->groupBy('produk_custom.nama_produk')->get();
        // query menampilkan warna berdasarkan produk
        $color = Warna::all();

        $getProdukCustomByPaginate = ProdukCustom::paginate(1);
        // load data kategori
        $getProdukCustomById = ProdukCustom::find($id);
        $FilterKategoriProdukCustom = $getProdukCustomById->ktgr_procus_id;
        $getProdukCustomIfTogetherWithKategoriProdukCustom = ProdukCustom::where('ktgr_procus_id', $FilterKategoriProdukCustom)->get();
        // dd($getProdukCustomIfTogetherWithKategoriProdukCustom);

        $kategori_produk_custom = KtgrProcus::all();
        $user = User::select('user_id', 'user_id')->get();
        return view('home.pilihbaju', [
            'title' => 'stok baju', //judul to header
            'instansi' => $data, //load data instansi
            'procus' => $procus,
            'id' => $id, //ambil id dari url dan kirim ke view
            'prdkgroup' => $prdkGroup,
            'colors' => $color,
            'kategori_produk_custom' => $kategori_produk_custom,
            'getProdukCustomByPaginate' => $getProdukCustomByPaginate,
            'user' => $user,
            'getProdukCustomById' => $getProdukCustomById,
            'getProdukCustomIfTogetherWithKategoriProdukCustom' => $getProdukCustomIfTogetherWithKategoriProdukCustom,
            // 'isiKeranjang' => $isiKeranjang,
        ]);
    }

    // detail custom setelah login
    public function SendToDetailBeforeCheckout($id)
    {
        $data = Instansi::all();
        $isiKeranjang = Shop_cart::where('user_id', '=', Auth::user()->user_id)->get()->count(); //hitung isi keranjang berdasarkan user yang login 'isiKeranjang' => $isiKeranjang,
        $procus = ProdukCustom::joinKategoriProdukCostum()->get();
        $prdkGroup = ProdukCustom::select('produk_custom.nama_produk')->groupBy('produk_custom.nama_produk')->get();
        // query menampilkan warna berdasarkan produk
        $color = Warna::all();

        $getProdukCustomByPaginate = ProdukCustom::paginate(1);
        // load data kategori
        $getProdukCustomById = ProdukCustom::find($id);
        $FilterKategoriProdukCustom = $getProdukCustomById->ktgr_procus_id;
        $getProdukCustomIfTogetherWithKategoriProdukCustom = ProdukCustom::where('ktgr_procus_id', $FilterKategoriProdukCustom)->get();
        // dd($getProdukCustomIfTogetherWithKategoriProdukCustom);
        // dd($procus);
        $payment = Payment::all();
        $kurir = Kurir::all();
        $kategori_produk_custom = KtgrProcus::all();
        $user = User::select('user_id', 'user_id')->get();
        return view('members.detailprodukcustom', [
            'title' => 'stok baju', //judul to header
            'instansi' => $data, //load data instansi
            'procus' => $procus,
            'id' => $id, //ambil id dari url dan kirim ke view
            'prdkgroup' => $prdkGroup,
            'colors' => $color,
            'kategori_produk_custom' => $kategori_produk_custom,
            'getProdukCustomByPaginate' => $getProdukCustomByPaginate,
            'user' => $user,
            'getProdukCustomById' => $getProdukCustomById,
            'getProdukCustomIfTogetherWithKategoriProdukCustom' => $getProdukCustomIfTogetherWithKategoriProdukCustom,
            'isiKeranjang' => $isiKeranjang,
            'kurir' => $kurir,
            'payment' => $payment
        ]);
    }
}
