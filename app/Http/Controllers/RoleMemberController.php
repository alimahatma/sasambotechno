<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\KtgrProcus;
use App\Models\Kurir;
use App\Models\Payment;
use App\Models\ProdukCustom;
use App\Models\Sablon;
use App\Models\User;
use App\Models\Warna;

class RoleMemberController extends Controller
{
    public function GetHome()
    {
        $procategori = KtgrProcus::joinToKategori()->get();
        $procus = ProdukCustom::joinProdukCostum()->get();
        $instansi = Instansi::all();
        $sablon = Sablon::all();
        $payment = Payment::all();
        $kurir = Kurir::all();
        return view('members.home', [
            'title' => 'home',
            'instansi' => $instansi,
            'kategoricustom' => $procategori,
            'procus' => $procus,
            'sablon' => $sablon,
            'payment' => $payment,
            'kurir' => $kurir,
        ]);
    }

    public function GetInvoice()
    {
        $data = Instansi::all();
        return view('members.yourInvoice', [
            'title' => 'histori invoice anda',
            'instansi' => $data
        ]);
    }
    public function GetProfile()
    {

        User::all();
        $data = Instansi::select('logo')->get();
        $users = User::all();
        return view('members.profile', [
            'title' => 'profile anda',
            'instansi' => $data,
            'users' => $users,
        ]);
    }
    public function DetailCustom($id)
    {
        $data = Instansi::all();

        // menampilkan foto produk, ukuran produk, berdasarkan nama produk yang sama
        $procategori = KtgrProcus::joinProdukCostum()->joinToKategori()->get();
        // dd($procategori);
        $procus = ProdukCustom::joinProdukCostum()->get();
        $prdkGroup = ProdukCustom::select('nama_produk')->joinProdukCostum()->groupBy('nama_produk', 'nama_produk')->get();

        // query menampilkan warna berdasarkan produk
        $color = Warna::all();
        $proColor = ProdukCustom::joinProdukCostum()
            ->join('warna', 'warna.warna_id', 'produk_custom.warna_id')
            ->get();
        $kustom = ProdukCustom::limit(2)->get();
        // dd($kustom);
        // query load data jasa kiri / kurir
        $jakir = Kurir::all();

        // load data sablon
        $sablon = Sablon::all();

        // load data kategori
        $k = KtgrProcus::all();
        $user = User::select('user_id', 'user_id')->get();
        // dd($user);
        return view('home.pilihbaju', [
            'title' => 'stok baju', //judul to header
            'instansi' => $data, //load data instansi
            'kategoriCus' => $procategori, //
            'procus' => $procus,
            'id' => $id, //ambil id dari url dan kirim ke view
            'prdkgroup' => $prdkGroup,
            'colors' => $color,
            'procolor' => $proColor,
            'jakir' => $jakir,
            'sablon' => $sablon,
            'kategori_produk_custom' => $k,
            'produkcustoms' => $kustom,
            'user' => $user,
        ]);
    }

    public function DetailCloth($id)
    {
        $data = Instansi::all();

        // menampilkan foto produk, ukuran produk, berdasarkan nama produk yang sama
        $procategori = KtgrProcus::joinProdukCostum()->joinToKategori()->get();
        // dd($procategori);
        $procus = ProdukCustom::joinProdukCostum()->get();
        $prdkGroup = ProdukCustom::select('produk_custom.nama_produk')
            ->joinKategoriProduk()
            ->groupBy('produk_custom.nama_produk')
            ->get();

        // query menampilkan warna berdasarkan produk
        $color = Warna::all();
        $proColor = ProdukCustom::joinProdukCostum()->joinWarna()->get(); //panggil scope function on model
        $kustom = ProdukCustom::limit(2)->get();
        // dd($kustom);
        // query load data jasa kiri / kurir
        $jakir = Kurir::all();

        // load data sablon
        $sablon = Sablon::all();

        // load data kategori
        $k = KtgrProcus::all();
        $pay = Payment::select('payment_id', 'pay_method')->get();
        $user = User::select('user_id', 'user_id')->get();
        // dd($user);
        return view('members.pilihbaju', [
            'title' => 'stok baju', //judul to header
            'instansi' => $data, //load data instansi
            'kategoriCus' => $procategori, //
            'procus' => $procus,
            'id' => $id, //ambil id dari url dan kirim ke view
            'prdkgroup' => $prdkGroup,
            'colors' => $color,
            'procolor' => $proColor,
            'jakir' => $jakir,
            'sablon' => $sablon,
            'kategori_produk_custom' => $k,
            'produkcustoms' => $kustom,
            'user' => $user,
            'payment' => $pay,
        ]);
    }

    // get data with jsons
    public function DataProcus($id)
    {
        $produk = ProdukCustom::select('foto_dep', 'foto_bel')->get();
        return response()->json([
            'produks' => $produk,
            'id' => $id,
        ]);
    }
}
