<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PartnerController extends Controller
{
    public function GetPartner()
    {
        $instansi = Instansi::select('logo')->get();
        $partner = Partner::all();
        return view('superadmin.partner', [
            'title' => 'kolaborasi perusahaan',
            'instansi' => $instansi,
            'partner' => $partner
        ]);
    }
    public function AddPartner(Request $req)
    {
        $req->validate([
            'nama_prshn' => 'required',
            'logo_prshn' => 'required|image|mimes:png,jpg,jpeg|max:1024',
            'alamat' => 'required',
        ]);
        $logoPartner = time() . '.' . $req->logo_prshn->extension();
        $req->logo_prshn->move(public_path('logo_prshn_partner'), $logoPartner);
        try {
            $data = new Partner([
                'nama_prshn' => $req->nama_prshn,
                'logo_prshn' => $logoPartner,
                'alamat' => $req->alamat,
            ]);
            $data->save();
            return redirect('partner')->with('success', 'berhasil di tambahkan');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('partner')->with('message', 'gagal di tambahkan');
        }
    }
    public function UpdtPartner(Request $req)
    {
        $req->validate([
            'partner_id' => 'required',
            'nama_prshn' => 'required',
            'logo_prshn' => 'required|image|mimes:png,jpg,jpeg|max:1024',
            'alamat' => 'required',
        ]);
        try {
            $logoPartner = time() . '.' . $req->logo_prshn->extension();
            $req->logo_prshn->move(public_path('logo_prshn_partner'), $logoPartner);
            $data = array(
                'nama_prshn' => $req->post('nama_prshn'),
                'logo_prshn' => $logoPartner,
                'alamat' => $req->post('alamat'),
            );
            Partner::where('partner_id', '=', $req->post('partner_id'))->update($data);
            return redirect('partner')->with('success', 'berhasil di update');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('partner')->with('message', 'gagal di update');
        }
    }
    public function DelPartner($id)
    {
        try {
            Partner::where('partner_id', $id)->delete();
            return redirect('partner')->with('success', 'berhasil di hapus');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('partner')->with('errors', 'gagal di hapus');
        }
    }
}
