<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use Illuminate\Http\Request;

class RoleMemberController extends Controller
{
    public function GetIndex()
    {
        $data = Instansi::all();
        return view('members.dashboard', [
            'title' => 'member',
            'instansi' => $data
        ]);
    }
}