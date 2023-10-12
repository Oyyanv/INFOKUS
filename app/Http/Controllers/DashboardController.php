<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function index(){
        return view('dashboard/index');
    }

    function siswa(){
        return view('dashboard/index');
    }

    function admin(){
        return view('dashboard/index');
    }
}
