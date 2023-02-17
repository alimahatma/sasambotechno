<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\KategoriProduk;
use App\Models\KtgrProcus;
use App\Models\KtgrProsoft;
use App\Models\ProdukCustom;
use App\Models\Tutorial;
use App\Models\Video;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function SendToIndex()
    {
        $instansi = Instansi::all();
        $ktgrprdk = KategoriProduk::all();
        $ktgrProsoft = KtgrProsoft::joinToKategoriProduk()->get();
        $ktgrCustom = KtgrProcus::joinToKategori()->get();
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
        $tutorial = Tutorial::all();
        return view('home.tutorial', [
            'title' => 'tutorial',
            'instansi' => $instansi,
            'tutorials' => $tutorial,
        ]);
    }

    public function SendToVideo()
    {
        $instansi = Instansi::all();
        $video = Video::limit(8)->orderBy('video_id', 'desc')->get();
        return view('home.video', [
            'title' => 'video',
            'instansi' => $instansi,
            'videos' => $video,
        ]);
    }

    public function SendToProduk()
    {
        $instansi = Instansi::all();
        $procategori = KtgrProcus::joinToKategori()->get();
        $procus = ProdukCustom::joinProdukCostum()->get();;
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
