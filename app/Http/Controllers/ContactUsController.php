<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use App\Models\Instansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactUsController extends Controller
{
    public function GetContactUs()
    {
        $instansi = Instansi::select('logo');
        $contact = ContactUs::all();
        return view('superadmin.contact_us', [
            'title' => 'kritik dan saran',
            'instansi' => $instansi,
            'contactus' => $contact
        ]);
    }

    // function komentar pelanggan
    public function Comment(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'telepon' => 'required',
            'saran' => 'required',
        ]);
        try {
            $data = new ContactUs([
                'nama' => $request->nama,
                'email' => $request->email,
                'telepon' => $request->telepon,
                'saran' => $request->saran,
            ]);
            $data->save();
            return redirect('contact')->with('success', 'saran berhasil di kirim');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('contact')->with('success', 'saran gagal di kirim');
        }
    }

    // function komentar super admin
    public function AddComment(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'telepon' => 'required',
            'saran' => 'required',
        ]);
        try {
            $data = new ContactUs([
                'nama' => $request->nama,
                'email' => $request->email,
                'telepon' => $request->telepon,
                'saran' => $request->saran,
            ]);
            $data->save();
            return redirect('contactus')->with('success', 'saran berhasil di kirim');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('contactus')->with('success', 'saran gagal di kirim');
        }
    }

    public function UpdtContactUs(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'telepon' => 'required',
            'saran' => 'required',
        ]);
        try {
            $data = array(
                'nama' => $request->post('nama'),
                'email' => $request->post('email'),
                'telepon' => $request->post('telepon'),
                'saran' => $request->post('saran'),
            );
            ContactUs::where('contact_us_id', '=', $request->post('contact_us_id'))->update($data);
            return redirect('contactus')->with('success', 'saran berhasil di update');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('contactus')->with('success', 'saran gagal di update');
        }
    }
    public function DelContactUs($id)
    {
        try {
            ContactUs::where('contact_us_id', '=', $id)->delete();
            return redirect('contactus')->with('success', 'saran berhasil di hapus');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('contactus')->with('success', 'saran gagal di hapus');
        }
    }
}
