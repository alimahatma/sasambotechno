<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Member;
use App\Models\Sablon;
use App\Models\Trx_sablon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TrxSablonController extends Controller
{
    public function GetTrxSablon()
    {
        if (Auth::user()->role == 'superadmin' && 'kasir' && 'produksi') {
            $member = Member::all();
            $data = DB::table('trx_sablon')
                ->join('member', 'member.member_id', '=', 'trx_sablon.member_id')
                ->join('sablon', 'sablon.sablon_id', '=', 'trx_sablon.sablon_id')
                ->get();
            $instansi = Instansi::select('logo')->get();
            return view('superadmin.trx_sablon', [
                'title' => 'transaksi sablon',
                'instansi' => $instansi,
                'transaksiSablon' => $data,
                'member' => $member,
            ]);
        } elseif (Auth::user()->role == 'pelanggan') {
            $sablon = Sablon::all();
            $member = Member::all();
            $instansi = Instansi::select('logo', 'whatsapp')->get();
            $data = DB::table('trx_sablon')
                ->join('member', 'member.member_id', '=', 'trx_sablon.member_id')
                ->join('sablon', 'sablon.sablon_id', '=', 'trx_sablon.sablon_id')
                ->get();
            return view('members.trackingSablon', [
                'title' => 'transaksi sablon',
                'sablon' => $sablon,
                'instansi' => $instansi,
                'member' => $member,
                'transaksiSablon' => $data,
            ]);
        }
    }
    public function AddTrxSablon(Request $req)
    {
        $req->validate([
            'member_id' => 'required',
            'sablon_id' => 'required',
            'jml' => 'required',
        ]);
        try {
            $datas = new Trx_sablon([
                'member_id' => $req->member_id,
                'sablon_id' => $req->sablon_id,
                'jml' => $req->jml,
            ]);
            $datas->save();
            return redirect('trackingsablon')->with('success', 'transaksi berhasil');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('trackingsablon')->with('message', 'transaksi gagal');
        }
    }
    public function UpdtTrxSablon(Request $req)
    {
        try {
            return redirect('trx_sablon')->with('success', 'transaksi berhasil di update');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('trx_sablon')->with('message', 'transaksi gagal di update');
        }
    }
    public function DeleteTrxSablon($id)
    {
        try {
            return redirect('trx_sablon')->with('success', 'transaksi berhasil di hapus');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('trx_sablon')->with('message', 'transaksi gagal di hapus');
        }
    }

    public function GetPesananAnda()
    {
        if (Auth::user()->role == 'pelanggan') {
            $member = Member::all();
            $instansi = Instansi::select('logo', 'whatsapp')->get();
            $data = DB::table('trx_sablon')
                ->join('member', 'member.member_id', '=', 'trx_sablon.member_id')
                ->join('sablon', 'sablon.sablon_id', '=', 'trx_sablon.sablon_id')
                ->get();
            return view('members.pesananAnda', [
                'title' => 'transaksi sablon',
                // 'sablon' => $sablon,
                'instansi' => $instansi,
                'member' => $member,
                'pesanan' => $data,
            ]);
        }
    }
}
