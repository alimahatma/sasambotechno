<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\KategoriProduk;
use App\Models\Kurir;
use App\Models\Member;
use App\Models\Produk;
use App\Models\Sablon;
use App\Models\User;
use App\Models\Warna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleMemberController extends Controller
{
    public function GetHome()
    {
        $ktgrs = Produk::select('nama_produk', 'foto_dep', 'foto_bel')->get();
        $data = Instansi::all();
        return view('members.home', [
            'title' => 'home',
            'instansi' => $data,
            'kategori' => $ktgrs,
        ]);
    }
    // public function GetIndex()
    // {
    //     $data = Instansi::all();
    //     return view('members.pilihbaju', [
    //         'title' => 'pilih pakaian',
    //         'instansi' => $data
    //     ]);
    // }
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
    public function GetCloth()
    {
        $warna = Warna::all();
        $product = DB::table('produk')->join('warna', 'warna.warna_id', '=', 'produk.warna_id')->get();
        $data = Instansi::all();
        $prdk = DB::table('produk')
            ->join('ktgr_produk', 'ktgr_produk.ktgr_id', '=', 'produk.ktgr_id')
            ->join('warna', 'warna.warna_id', '=', 'produk.warna_id')
            ->join('supplier', 'supplier.supplier_id', '=', 'produk.supplier_id')
            ->get();
        // dd($prdk);
        $ktgrs = Produk::select('nama_produk', 'foto_dep', 'foto_bel')->get();
        // dd($ktgrs);
        return view('members.pilihbaju', [
            'title' => 'stok baju',
            'instansi' => $data,
            'produks' => $prdk,
            'warna' => $warna,
            'product' => $product,
            'kategori' => $ktgrs,
        ]);
    }
}
