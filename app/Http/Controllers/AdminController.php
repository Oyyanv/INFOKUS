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

    function detailsiswa(){
        return view('admin/datasiswa/detailsiswa');
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

    //tagihan
    function indextagihan(){
        return view('admin/datatagihan/index');
    }

    function tambahtagihan(){
        return view('admin/datatagihan/tambah');
    }
    //tagihan

    //user
    function indexuser(){
        return view('admin/datauser/index');
    }
    //user

    //gurustaff
    function indexstaff(){
        return view('admin/gurustaff/index');
    }

    function tambahstaff(){
        return view('admin/gurustaff/tambah');
    }
}
