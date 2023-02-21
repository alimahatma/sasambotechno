<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    public function GetDataCart()
    {
        $instansi = Instansi::select('logo');
        return view('members.mycart', [
            'title' => 'keranjang saya',
            'instansi' => $instansi,
        ]);
    }
}
