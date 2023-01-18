<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleAdminController extends Controller
{
    public function GetIndex()
    {
        return view('admin.index', [
            'title' => 'admin'
        ]);
    }
}
