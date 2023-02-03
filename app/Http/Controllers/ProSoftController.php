<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\KategoriProduk;
use App\Models\KtgrProsoft;
use App\Models\ProdukSoftware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProSoftController extends Controller
{
    public function GetAll()
    {
        $ktgr = KategoriProduk::all();
        $ktgrPsof = KtgrProsoft::all();
        $inst = Instansi::select('logo')->get();
        $software = DB::table('prdk_software')
            ->join('ktgr_prdk_software', 'ktgr_prdk_software.ktgr_prosoft_id', '=', 'prdk_software.ktgr_prosoft_id')
            ->join('ktgr_produk', 'ktgr_produk.ktgr_id', '=', 'ktgr_prdk_software.ktgr_id')
            ->get();
        // dd($software);
        return view('superadmin.prosoft', [
            'title' => 'produk software',
            'instansi' => $inst,
            'prosoft' => $software,
            'ktgrProsoft' => $ktgrPsof,
            'kategori' => $ktgr,
        ]);
    }
    public function AddProsoft(Request $request)
    {
        $data = $request->validate([
            'ktgr_id' => 'required',
            'ktgr_prosoft_id' => 'required',
            'jenis_software' => 'required',
            'foto_software' => 'required|image|mimes:png,jpg,jpeg|max:1024',
            'deskripsi_prosoft' => 'required',
        ]);
        // dd($data);
        try {
            // convert foto produk software
            $FotoProsoft = time() . '.' . $request->foto_software->extension();
            $request->foto_software->move(public_path('foto_produk'), $FotoProsoft);

            $data = new ProdukSoftware([
                'ktgr_id' => $request->ktgr_id,
                'ktgr_prosoft_id' => $request->ktgr_prosoft_id,
                'jenis_software' => $request->jenis_software,
                'foto_software' => $FotoProsoft,
                'deskripsi_prosoft' => $request->deskripsi_prosoft,
            ]);
            $data->save();
            return redirect('prosoft')->with('success', 'data berhasil di tambahkan..!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('prosoft')->with('message', 'data gagal di update');
        }
    }
    public function UpdtProsoft(Request $request)
    {

        $data = $request->validate([
            'ktgr_id' => 'required',
            'ktgr_prosoft_id' => 'required',
            'jenis_software' => 'required',
            'foto_software' => 'required|image|mimes:png,jpg,jpeg|max:1024',
            'deskripsi_prosoft' => 'required',
        ]);
        dd($data);
        try {
            // convert foto depan produk
            $FotoProsoft = time() . '.' . $request->foto_software->extension();
            $request->foto_software->move(public_path('foto_produk'), $FotoProsoft);

            $data = array(
                'ktgr_id' => $request->post('ktgr_id'),
                'ktgr_prosoft_id' => $request->post('ktgr_prosoft_id'),
                'jenis_software' => $request->post('jenis_software'),
                'foto_software' => $FotoProsoft,
                'deskripsi_prosoft' => $request->post('deskripsi_prosoft'),
            );
            ProdukSoftware::where('prosoft_id', '=', $request->post('prosoft_id'))->update($data);
            return redirect('prosoft')->with('success', 'data berhasil di update..!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('prosoft')->with('message', 'data gagal di update');
        }
    }
    public function DeleteProsoft($id)
    {
        try {
            ProdukSoftware::where('prosoft_id', '=', $id)->delete();
            return redirect('prosoft')->with('success', 'data berhasil di hapus');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('prosoft')->with('message', 'data gagal di hapus');
        }
    }
}
