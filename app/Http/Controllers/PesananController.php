<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function GetPesanan()
    {
        $data = Pesanan::all();
        $instansi = Instansi::select('logo')->get();
        return view('superadmin.pesanan', [
            'title' => 'Data pesanan',
            'instansi' => $instansi,
            'pesanan' => $data,
        ]);
    }
}
