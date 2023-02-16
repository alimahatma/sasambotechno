<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PesananController extends Controller
{
    public function GetPesanan()
    {
        if (Auth::user()->role == 'superadmin') {
            $data = Pesanan::joinToProdukCustom()->joinToKategoriProdukCustom()->joinToWarna()
                ->joinToMember()->joinToSablon()->joinToKurir()->joinToPayment()->get();
            $instansi = Instansi::select('logo')->get();
            return view('superadmin.pesanan', [
                'title' => 'Data pesanan',
                'instansi' => $instansi,
                'pesanan' => $data,
            ]);
        } elseif (Auth::user()->role == 'kasir') {
            $data = Pesanan::joinToProdukCustom()->joinToKategoriProdukCustom()->joinToWarna()
                ->joinToMember()->joinToSablon()->joinToKurir()->joinToPayment()->get();
            $instansi = Instansi::select('logo')->get();
            return view('superadmin.pesanan', [
                'title' => 'Data pesanan',
                'instansi' => $instansi,
                'pesanan' => $data,
            ]);
        } elseif (Auth::user()->role == 'produksi') {
            $data = Pesanan::joinToProdukCustom()->joinToKategoriProdukCustom()->joinToWarna()
                ->joinToMember()->joinToSablon()->joinToKurir()->joinToPayment()->get();
            $instansi = Instansi::select('logo')->get();
            return view('superadmin.pesanan', [
                'title' => 'Data pesanan',
                'instansi' => $instansi,
                'pesanan' => $data,
            ]);
        } else {
            echo '419 page expired';
        }
    }

    public function AddPesanan(Request $req)
    {
        if ($req->desain1 == true) {
            //procus_id color	member_id	sablon_id	kurir_id	payment_id	jml_order	desain1	desain2 desain3	b_dp	b_lunas	t_pesan	pay_status	tgl_order	stts_produksi	status_pesanan
            $req->validate([
                'procus_id' => 'required',
                'color' => 'required',
                'member_id' => 'required',
                'size_order' => 'required',
                'sablon_id' => 'required',
                'kurir_id' => 'required',
                'payment_id' => 'required',
                'jml_order' => 'required',
                'desain1' => 'required|image|mimes:png,jpg,jpeg|max:2048',
                'desain2' => 'required|image|mimes:png,jpg,jpeg|max:2048',
                'desain3' => 'required|image|mimes:png,jpg,jpeg|max:2048',
                't_pesan' => 'required',
                'tgl_order' => 'required',
            ]);
            try {
                // convert desain sablon to folder desain
                $design1 = time() . '.' . $req->desain1->extension();
                $req->desain1->move(public_path('desain1'), $design1);

                // convert desain sablon to folder desain
                $design2 = time() . '.' . $req->desain2->extension();
                $req->desain2->move(public_path('desain2'), $design2);

                // convert desain sablon to folder desain
                $design3 = time() . '.' . $req->desain3->extension();
                $req->desain3->move(public_path('desain3'), $design3);

                $data = new Pesanan([
                    'procus_id' => $req->procus_id,
                    'color' => $req->color,
                    'member_id' => $req->member_id,
                    'size_order' => $req->size_order,
                    'sablon_id' => $req->sablon_id,
                    'kurir_id' => $req->kurir_id,
                    'payment_id' => $req->payment_id,
                    'jml_order' => $req->jml_order,
                    'tgl_order' => $req->tgl_order,
                    'desain1' => $design1,
                    'desain2' => $design2,
                    'desain3' => $design3,
                ]);
                dd($data);
                $data->save();
                return redirect('pesanananda')->with('success', 'pesanan berhasil');
            } catch (\Exception $e) {
                Log::error($e->getMessage());
                return redirect('home')->with('errors', 'gagal');
            }
        } elseif ($req->desain1 == false) {
            $req->validate([
                'procus_id' => 'required',
                'color' => 'required',
                'member_id' => 'required',
                'size_order' => 'required',
                'sablon_id' => 'required',
                'kurir_id' => 'required',
                'payment_id' => 'required',
                'jml_order' => 'required',
                't_pesan' => 'required',
                'tgl_order' => 'required',
            ]);
            try {
                $data = new Pesanan([
                    'procus_id' => $req->procus_id,
                    'color' => $req->color,
                    'member_id' => $req->member_id,
                    'size_order' => $req->size_order,
                    'sablon_id' => $req->sablon_id,
                    'kurir_id' => $req->kurir_id,
                    'payment_id' => $req->payment_id,
                    'jml_order' => $req->jml_order,
                    't_pesan' => $req->t_pesan,
                    'tgl_order' => $req->tgl_order,
                ]);
                // dd($data);
                $data->save();
                return redirect('pesanananda')->with('success', 'pesanan berhasil');
            } catch (\Exception $e) {
                Log::error($e->getMessage());
                return redirect('home')->with('errors', 'gagal');
            }
        }
    }

    public function BayarProdukCustom(Request $req)
    {
        $req->validate([
            'jml_dp' => 'required',
            'b_dp' => 'required|image|mimes:png, jpg, jpeg|max:2048',
            'pay_status' => 'required',
        ]);
        try {
            $buktiDP = time() . '.' . $req->b_dp->extension();
            $req->b_dp->move(public_path('pembayaran/bukti_dp'), $buktiDP);
            $bayar = array(
                'jml_dp' => $req->post('jml_dp'),
                'b_dp' => $buktiDP,
                'pay_status' => $req->post('pay_status'),
            );
            // dd($bayar);
            Pesanan::where('pesanan_id', '=', $req->post('pesanan_id'))->update($bayar);
            return redirect('pesanananda')->with("success", 'proses pembayaran berhasil');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('pesanananda')->with('errors', 'pembayaran gagal silahkan coba lagi');
        }
    }

    public function BayarLunas(Request $req)
    {
        $req->validate([
            'jml_lunas' => 'required',
            'b_lunas' => 'required|image:png. jpg, jpeg|max:2048',
            'pay_status' => 'required',
        ]);
        try {
            $buktiLunas = time() . '.' . $req->b_lunas->extension();
            $req->b_lunas->move(public_path('pembayaran/bukti_lunas'), $buktiLunas);

            $bayarLunas = array(
                'jml_lunas' => $req->post('jml_lunas'),
                'b_lunas' => $buktiLunas,
                'pay_status' => $req->post('pay_status'),
            );
            Pesanan::where('pesanan_id', '=', $req->post('pesanan_id'))->update($bayarLunas);
            return redirect('invoice')->with('success', 'pembayaran berhasil');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('pesanananda')->with('errors', 'pembayaran gagal silahkan coba lagi');
        }
    }

    public function ValidasiPesanan(Request $req)
    {
        $req->validate([
            'pay_status' => 'required',
            'status_pesanan' => 'required'
        ]);
        try {
            $validationPayment = array(
                'pay_status' => $req->post('pay_status'),
                'status_pesanan' => $req->post('status_pesanan'),
            );
            Pesanan::where('pesanan_id', '=', $req->post('pesanan_id'))->update($validationPayment);
            return redirect('pesanan')->with('success', 'validasi berhasil');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('pesanan')->with('errors', 'validasi pembayaran');
        }
    }

    public function ValidasiProduction(Request $req)
    {
        $req->validate([
            'stts_produksi' => 'required'
        ]);
        try {
            $validasiProduksi = array(
                'stts_produksi' => $req->post('stts_produksi'),
            );
            Pesanan::where('pesanan_id', '=', $req->post('pesanan_id'))->update($validasiProduksi);
            return redirect('pesanan')->with('success', 'rubah status produksi berhasil');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('pesanan')->with('errors', 'rubah status produksi gagal');
        }
    }

    public function Discount(Request $req)
    {
        $req->validate([
            '' => '',
        ]);
        try {
            $diskon = array(
                '' => $req->post(''),
                '' => $req->post(''),
                '' => $req->post(''),
            );
            Pesanan::where('pesanan_id', '=', $req->post('pesanan_id'))->update();
            return redirect('pesanan')->with('success', 'diskon berhasil');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('pesanan')->with('errors', 'diskon gagal');
        }
    }

    public function DeletePesanan($id)
    {
        try {
            Pesanan::where('pesanan_id', '=', $id)->delete();
            return redirect('pesanan')->with('success', 'pesanan berhasil di hapus');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('pesanan')->with('success', 'pesanan gagal di hapus');
        }
    }
}
