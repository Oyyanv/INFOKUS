<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Ortu;
use App\Models\Gurustaff;
use App\Models\User;

class DashboardController extends Controller
{
    function index(){

        $siswaTotal = Siswa::count();
        $orangtuaTotal = Ortu::count();
        $gurustaffTotal = Gurustaff::count();
        $userTotal = User::count();
        
        return view('dashboard/index', compact('siswaTotal','orangtuaTotal','gurustaffTotal','userTotal'));
    }

    

    function siswa(){
        return view('dashboard/index');
    }

    function admin(){
        return view('dashboard/index');
    }
}
