<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserVIewController extends Controller
{
    function index()
    {
        $bandara = DB::table('bandara')->get();

        return view('user/index', ['bandara' => $bandara]);
    }
}
