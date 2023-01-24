<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\KategoriProduk;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function SendToIndex()
    {
        $instansi = Instansi::all();
        $ktgrprdk = KategoriProduk::all();
        $produk = Produk::all();
        $stok = DB::table('stok')->join('produk', 'produk.produk_id', '=', 'stok.produk_id')->join('ktgr_produk', 'ktgr_produk.ktgr_id', '=', 'produk.ktgr_id');
        return view('home.landingpage', [
            'title' => 'index',
            'stoks' => $stok,
            'instansi' => $instansi,
            'ktgrproduk' => $ktgrprdk,
            'produk' => $produk,
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
        $produk = Produk::all();
        return view('home.blog', [
            'title' => 'blog',
            'instansi' => $instansi,
            'ktgrproduk' => $ktgrprdk,
            'produk' => $produk,
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
        $produk = Produk::all();
        return view('home.produk', [
            'title' => 'produk',
            'produk' => $produk,
            'instansi' => $instansi,
        ]);
    }
    public function SendToContact()
    {
        $instansi = Instansi::all();
        $produk = Produk::all();
        return view('home.contact', [
            'title' => 'kontak',
            // 'produk' => $produk,
            'instansi' => $instansi,
        ]);
    }
}
