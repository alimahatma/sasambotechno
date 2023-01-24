<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function GetTransaksi()
    {
        $data = Transaksi::all();
        $instansi = Instansi::select('logo')->get();
        return view('superadmin.transaksi', [
            'title' => 'Data transaksi',
            'instansi' => $instansi,
            'transaksi' => $data,
        ]);
    }
}
