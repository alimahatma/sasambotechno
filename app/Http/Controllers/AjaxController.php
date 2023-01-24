<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Redirect, Response;

use App\Models\User;

class AjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['users'] = User::orderBy('No', 'desc')->paginate(8);

        return view('list', $data);
    }


    public function show($id)
    {
        $where = array('id' => $id);
        $user  = User::where($where)->first();

        return Response::json($user);
    }
}
