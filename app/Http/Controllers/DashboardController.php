<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function GetViewDashboard()
    {
        if (Auth::user()->role == "superadmin" || Auth::user()->role == "kasir") {
            $instansi = Instansi::select('logo')->get();
            $pesananPending = Pesanan::where('status_pesanan', '=', 'pending')->count();
            $pesananDibayar = Pesanan::where('pay_status', '=', 'bayar')->count();
            $pesananDiProduksi = Pesanan::where('stts_produksi', '=', ['produksi', 'packing', 'kasir'])->count();
            $pesananSelesai = Pesanan::where('status_pesanan', '=', 'selesai')->count();
            $sumbuYVertikal = Pesanan::selectRaw('count(*) data')
                ->groupBy(DB::raw("monthname(tgl_order)"))
                ->pluck('data'); //megelompokkan jumlah barang terjual perbulan

            $sumbuXHorizontal = Pesanan::select(DB::raw("MONTHNAME(tgl_order) as bulan"))
                ->groupBy(DB::raw("MONTHNAME(tgl_order)"))
                ->pluck('bulan'); //mengambil data nama bulan berdasarkan tanggal order
            return view('superadmin.dashboard', [
                'title' => 'dashboard',
                'instansi' => $instansi,
                'pesananPending' => $pesananPending,
                'pesananDibayar' => $pesananDibayar,
                'pesananDiProduksi' => $pesananDiProduksi,
                'pesananSelesai' => $pesananSelesai,
                'sumbuYVertikal' => $sumbuYVertikal,
                'sumbuXHorizontal' => $sumbuXHorizontal
            ]);
        } else {
            print("403");
        }

        // return view('superadmin.dashboard', compact('labels', 'data', 'instansi'));
    }
}
