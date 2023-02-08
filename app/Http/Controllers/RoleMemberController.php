<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\KategoriProduk;
use App\Models\KtgrProcus;
use App\Models\Kurir;
use App\Models\ProdukCustom;
use App\Models\Sablon;
use App\Models\User;
use App\Models\Warna;
use Illuminate\Support\Facades\DB;

class RoleMemberController extends Controller
{
    public function GetHome()
    {
        $procategori = DB::table('ktgr_prdk_custom')->join('ktgr_produk', 'ktgr_produk.ktgr_id', '=', 'ktgr_prdk_custom.ktgr_procus_id')->get();
        $procus = DB::table('produk_custom')->join('ktgr_prdk_custom', 'ktgr_prdk_custom.ktgr_procus_id', '=', 'produk_custom.ktgr_procus_id')->get();
        $data = Instansi::all();
        return view('members.home', [
            'title' => 'home',
            'instansi' => $data,
            'kategoricustom' => $procategori,
            'procus' => $procus,
        ]);
    }
    public function GetKurirs()
    {
        $kurir = Kurir::all();
        $data = Instansi::all();
        return view('members.trackingKurir', [
            'title' => 'kurir tersedia',
            'instansi' => $data,
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
        $member = DB::table('member')->join('users', 'users.user_id', '=', 'member.user_id')->get();
        return view('members.profile', [
            'title' => 'profile anda',
            'instansi' => $data,
            'member' => $member,
        ]);
    }
    public function DetailCustom($id)
    {
        $data = Instansi::all();

        // menampilkan foto produk, ukuran produk, berdasarkan nama produk yang sama
        $procategori = DB::table('ktgr_prdk_custom')
            ->join('ktgr_produk', 'ktgr_produk.ktgr_id', '=', 'ktgr_prdk_custom.ktgr_procus_id')
            ->join('produk_custom', 'ktgr_prdk_custom.ktgr_procus_id', '=', 'produk_custom.ktgr_procus_id')
            ->get();
        // dd($procategori);
        $procus = DB::table('produk_custom')->join('ktgr_prdk_custom', 'ktgr_prdk_custom.ktgr_procus_id', '=', 'produk_custom.ktgr_procus_id')->get();
        $prdkGroup = DB::table('produk_custom')
            ->select('nama_produk')
            ->join('ktgr_prdk_custom', 'ktgr_prdk_custom.ktgr_procus_id', '=', 'produk_custom.ktgr_procus_id')
            ->groupBy('nama_produk', 'nama_produk')
            ->get();

        // query menampilkan warna berdasarkan produk
        $color = Warna::all();
        $proColor = DB::table('produk_custom')
            ->join('ktgr_prdk_custom', 'ktgr_prdk_custom.ktgr_procus_id', '=', 'produk_custom.ktgr_procus_id')
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
        ]);
    }
}
