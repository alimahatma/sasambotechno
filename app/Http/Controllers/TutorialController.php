<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Tutorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TutorialController extends Controller
{
    public function GetAllTutorial()
    {
        $instansi = Instansi::all();
        $tutorial = Tutorial::all();
        return view('superadmin.tutorial', [
            'title' => 'tutorial',
            'tutorial' => $tutorial,
            'instansi' => $instansi,
        ]);
    }
    public function AddTutorial(Request $req)
    {
        $req->validate([
            'judul' => 'required',
            'gambar' => 'required|mimes:png,jpg,jpeg|max:1024',
            'materi' => 'required',
            'penulis' => 'required',
        ]);
        try {
            $Tgambar = time() . '.' . $req->gambar->extension();
            $req->gambar->move(public_path('gambars'), $Tgambar);
            $data = new Tutorial([
                'judul' => $req->judul,
                'gambar' => $Tgambar,
                'materi' => $req->materi,
                'penulis' => $req->penulis,
            ]);
            $data->save();
            return redirect('tutorial')->with('success', 'berhasil menambahkan data');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('tutorial')->with('errors', 'gagal');
        }
    }
    public function UpdtTutorial(Request $req)
    {
        $req->validate([
            'judul' => 'required',
            'gambar' => 'required|mimes:png,jpg,jpeg|max:1024',
            'materi' => 'required',
            'penulis' => 'required',
        ]);
        try {
            $Tgambar = time() . '.' . $req->gambar->extension();
            $req->gambar->move(public_path('gambars'), $Tgambar);
            $data = array(
                'judul' => $req->post('judul'),
                'gambar' => $Tgambar,
                'materi' => $req->post('materi'),
                'penulis' => $req->post('penulis'),
            );
            Tutorial::where('tutorial_id', $req->post('tutorial_id'))->update($data);
            return redirect('tutorial')->with('success', 'berhasil mengupdate data');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('tutorial')->with('errors', 'gagal');
        }
    }
    public function DelTutorial($id)
    {
        try {
            Tutorial::where('tutorial_id', $id)->delete();
            return redirect('tutorial')->with('success', 'berhasil menghapus data');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('tutorial')->with('errors', 'gagal');
        }
    }
}
