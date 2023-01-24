<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SupplierController extends Controller
{
    public function GetSupplier()
    {
        $data = Supplier::all();
        $instansi = Instansi::select('logo')->get();
        return view('superadmin.supplier', [
            'title' => 'Data supplier',
            'instansi' => $instansi,
            'supplier' => $data,
        ]);
    }
    public function AddSupplier(Request $req)
    {
        $req->validate([
            'nama_supplier' => 'required',
            'alamat' => 'required',
            'contact' => 'required',
        ]);
        try {
            $data = new Supplier([
                'nama_supplier' => $req->nama_supplier,
                'alamat' => $req->alamat,
                'contact' => $req->contact,
            ]);
            $data->save();
            return redirect('supplier')->with('success', 'berhasil di tambah');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('supplier')->with('message', 'gagal');
        }
    }
    public function UpdtSupplier(Request $req)
    {
        $req->validate([
            'nama_supplier' => 'required',
            'alamat' => 'required',
            'contact' => 'required',
        ]);
        try {
            $data = array(
                'nama_supplier' => $req->post('nama_supplier'),
                'alamat' => $req->post('alamat'),
                'contact' => $req->post('contact')
            );
            Supplier::where('supplier_id', '=', $req->post('supplier_id'))->update($data);
            return redirect('supplier')->with('success', 'berhasil di update');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('supplier')->with('message', 'gagal');
        }
    }
    public function DeleteSupplier($id)
    {
        try {
            Supplier::where('supplier_id', '=', $id)->delete();
            return redirect('supplier')->with('success', 'berhasil di hapus');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('supplier')->with('message', 'gagal');
        }
    }
}
