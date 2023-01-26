<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use Illuminate\Http\Request;

class RoleAdminController extends Controller
{
    public function GetIndex()
    {
        $data = Instansi::all();
        return view('admin.index', [
            'title' => 'admin',
            'instansi' => $data
        ]);
    }
}
