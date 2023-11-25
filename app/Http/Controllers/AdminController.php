<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{   //datasiswa
    function index(){
        return view('admin/datasiswa/index');
    }

    function tambah(){
        return view('admin/datasiswa/tambah');
    }
    //datasiswa

    //spp
    function indexspp(){
        return view('admin/dataspp/index');
    }
    //spp

    //ortu
    function indexortu(){
        return view('admin/dataortu/index');
    }

    function tambahortu(){
        return view('admin/dataortu/tambah');
    }
    //ortu
}
