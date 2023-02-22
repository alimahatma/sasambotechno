<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Trx_sablon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

    // public function TrxSablon(Request $request)
    // {
    //     $request->validate([
    //         '' => 'required',
    //         '' => 'required',
    //         '' => 'required',
    //         '' => 'required',
    //     ]);
    //     try {
    //         $trxSablon = new Trx_sablon([
    //             ''=>$request->,
    //             ''=>$request->,
    //             ''=>$request->,
    //             ''=>$request->,
    //         ]);
    //         $trxSablon->save();
    //         return redirect('/pesanananda')->with('success','transaksi berhasil');
    //     } catch (\Exception $e) {
    //         Log::error($e->getMessage());
    //         return redirect('/cart')->with('errors','transaksi gagal..!');
    //     }
    // }
    // public function TrxPakaiancustom(Request $request)
    // {
    //     $request->validate([
    //         '' => 'required',
    //         '' => 'required',
    //         '' => 'required',
    //         '' => 'required',
    //     ]);
    //     try {
    //         $trxSablon = new Trx_sablon([
    //             ''=>$request->,
    //             ''=>$request->,
    //             ''=>$request->,
    //             ''=>$request->,
    //         ]);
    //         $trxSablon->save();
    //         return redirect('/pesanananda')->with('success','transaksi berhasil');
    //     } catch (\Exception $e) {
    //         Log::error($e->getMessage());
    //         return redirect('/cart')->with('errors','transaksi gagal..!');
    //     }
    // }
    // public function AllTrx()
    // {
    //     // jika transaksi masih dalam satu fungsi maka pakaitransaction
    //     // DB::transaction(function(){
    //     // $this->TrxSablon();
    //     // $this->TrxPakaiancustom();
    //     // });

    //     try {
    //         DB::beginTransaction();
    //         $this->TrxSablon();
    //         $this->TrxPakaiancustom();
    //         DB::commit();
    //         $trxSablon->save();
    //         return redirect('/pesanananda')->with('success','transaksi berhasil');
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //     }
    //     // jika transaksi menggunakan fungsi yang berbeda maka gunakan begin transaction

    // }
}
