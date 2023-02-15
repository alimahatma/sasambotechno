<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Payment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function GetPayment()
    {
        $instansi = Instansi::select('logo')->get();
        $payment = Payment::orderBy('payment_id', 'desc')->get();
        // dd($instansi);
        return view('superadmin.payment', [
            'title' => 'payment',
            'instansi' => $instansi,
            'payment' => $payment,
        ]);
    }
    public function AddPayment(Request $req)
    {
        $req->validate([
            'pay_method' => 'required',
        ]);
        try {
            $data = new Payment([
                'pay_method' => $req->post('pay_method')
            ]);
            $data->save();
            return redirect('payment')->with('success', 'berhasil di tambahkan');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('payment')->with('message', 'gagal di tambahkan');
        }
    }
    public function UpdtPayment(Request $req)
    {
        $req->validate([
            'payment_id' => 'required',
            'pay_method' => 'required',
        ]);
        try {
            $data = array(
                'pay_method' => $req->post('pay_method')
            );
            Payment::where('payment_id', '=', $req->post('payment_id'))->update($data);
            return redirect('payment')->with('success', 'berhasil di update');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('payment')->with('message', 'gagal di update');
        }
    }
    public function DelPayment($id)
    {
        try {
            Payment::where('payment_id', $id)->delete();
            return redirect('payment')->with('success', 'berhasil di hapus');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('payment')->with('errors', 'gagal di hapus');
        }
    }
}
