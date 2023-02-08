<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VideoController extends Controller
{
    public function GetAllVideo()
    {
        $instansi = Instansi::all();
        $video = Video::all();
        return view('superadmin.video', [
            'title' => 'videos',
            'video' => $video,
            'instansi' => $instansi,
        ]);
    }
    public function AddVideo(Request $req)
    {
        $req->validate([
            'video_link' => 'required',
            'deskripsi' => 'required'
        ]);
        try {
            $data = new Video([
                'video_link' => $req->video_link,
                'deskripsi' => $req->deskripsi,
            ]);
            $data->save();
            return redirect('video')->with('success', 'berhasil menambahkan data');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('video')->with('errors', 'gagal');
        }
    }
    public function UpdtVideo(Request $req)
    {
        $req->validate([
            'video_link' => 'required',
            'deskripsi' => 'required'
        ]);
        try {
            $data = array(
                'video_link' => $req->post('video_link'),
                'deskripsi' => $req->post('deskripsi'),            );
            Video::where('video_id', $req->post('video_id'))->update($data);
            return redirect('video')->with('success', 'berhasil mengupdate data');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('video')->with('errors', 'gagal');
        }
    }
    public function DelVideo($id)
    {
        try {
            Video::where('video_id', $id)->delete();
            return redirect('video')->with('success', 'berhasil menghapus data');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('video')->with('errors', 'gagal');
        }
    }
}
