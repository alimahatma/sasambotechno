<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Member;
use App\Models\Sablon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleMemberController extends Controller
{
    public function GetHome()
    {
        $data = Instansi::all();
        return view('members.home', [
            'title' => 'home',
            'instansi' => $data
        ]);
    }
    public function GetIndex()
    {
        $data = Instansi::all();
        return view('members.pilihbaju', [
            'title' => 'pilih pakaian',
            'instansi' => $data
        ]);
    }
    public function GetSablon()
    {
        $member = Member::all();
        $sablon = Sablon::all();
        $data = Instansi::all();
        return view('members.trackingSablon', [
            'title' => 'jenis sablon',
            'instansi' => $data,
            'sablon' => $sablon,
            'member' => $member,
        ]);
    }
    public function GetKurirs()
    {
        $data = Instansi::all();
        return view('members.trackingKurir', [
            'title' => 'kurir tersedia',
            'instansi' => $data
        ]);
    }
    public function GetInvoice()
    {
        $data = Instansi::all();
        return view('members.yourInvoice', [
            'title' => 'histori invoice anda',
            'instansi' => $data
        ]);
    }
    public function GetProfile()
    {

        User::all();
        $data = Instansi::select('logo')->get();
        $member = DB::table('member')->join('users', 'users.user_id', '=', 'member.user_id')->get();
        return view('members.profile', [
            'title' => 'profile anda',
            'instansi' => $data,
            'member' => $member,
        ]);
    }
}
