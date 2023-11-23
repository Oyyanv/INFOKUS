<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    function index(){
        return view('admin/datasiswa/index');
    }

    function tambah(){
        return view('admin/datasiswa/tambah');
    }
}
