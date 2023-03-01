<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function GetViewDashboard()
    {
        $instansi = Instansi::select('logo')->get();
        $pesananPending = Pesanan::where('status_pesanan', '=', 'pending')->count();
        $pesananDibayar = Pesanan::where('pay_status', '=', 'bayar')->count();
        $pesananDiProduksi = Pesanan::where('stts_produksi', '=', ['produksi', 'packing', 'kasir'])->count();
        $pesananSelesai = Pesanan::where('status_pesanan', '=', 'selesai')->count();
        // dd($pesananPending);
        return view('superadmin.dashboard', [
            'title' => 'dashboard',
            'instansi' => $instansi,
            'pesananPending' => $pesananPending,
            'pesananDibayar' => $pesananDibayar,
            'pesananDiProduksi' => $pesananDiProduksi,
            'pesananSelesai' => $pesananSelesai,
        ]);
    }
}
