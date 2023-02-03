<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\KategoriProduk;
use App\Models\Produk;
use App\Models\ProdukCustom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function SendToIndex()
    {
        $instansi = Instansi::all();
        $ktgrprdk = KategoriProduk::all();
        $ktgrProsoft = DB::table('ktgr_prdk_software')->join('ktgr_produk', 'ktgr_produk.ktgr_id', '=', 'ktgr_prdk_software.ktgr_id')->get();
        $ktgrCustom = DB::table('ktgr_prdk_custom')->join('ktgr_produk', 'ktgr_produk.ktgr_id', '=', 'ktgr_prdk_custom.ktgr_id')->get();
        return view('home.landingpage', [
            'title' => 'index',
            'instansi' => $instansi,
            'ktgrproduk' => $ktgrprdk, //load kategori produk for slide
            'ktgrprosoft' => $ktgrProsoft, //load kategori produk software
            'ktgrprocus' => $ktgrCustom, //load kategori produk custom
        ]);
    }
    public function SendToAbout()
    {
        $instansi = Instansi::all();
        return view('home.index', [
            'title' => 'tentang',
            'instansi' => $instansi,
        ]);
    }
    public function SendToBlog()
    {
        $instansi = Instansi::all();
        $ktgrprdk = KategoriProduk::all();
        $produkCustom = ProdukCustom::all();
        return view('home.blog', [
            'title' => 'blog',
            'instansi' => $instansi,
            'ktgrproduk' => $ktgrprdk,
            'produk' => $produkCustom,
        ]);
    }
    public function SendToTutorial()
    {
        $instansi = Instansi::all();
        return view('home.tutorial', [
            'title' => 'tutorial',
            'instansi' => $instansi,
        ]);
    }
    public function SendToVideo()
    {
        $instansi = Instansi::all();
        return view('home.video', [
            'title' => 'video',
            'instansi' => $instansi,
        ]);
    }
    public function SendToProduk()
    {
        $instansi = Instansi::all();
        $procategori = DB::table('ktgr_prdk_custom')->join('ktgr_produk', 'ktgr_produk.ktgr_id', '=', 'ktgr_prdk_custom.ktgr_procus_id')->get();
        $procus = DB::table('produk_custom')->join('ktgr_prdk_custom', 'ktgr_prdk_custom.ktgr_procus_id', '=', 'produk_custom.ktgr_procus_id')->get();
        return view('home.produk', [
            'title' => 'produk',
            'kategoricustom' => $procategori,
            'procus' => $procus,
            'instansi' => $instansi,
        ]);
    }
    public function SendToContact()
    {
        $instansi = Instansi::all();
        $produkCustom = ProdukCustom::all();
        return view('home.contact', [
            'title' => 'kontak',
            // 'produk' => $produkCustomCustom,
            'instansi' => $instansi,
        ]);
    }
}
