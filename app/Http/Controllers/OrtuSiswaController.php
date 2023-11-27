<?php

namespace App\Http\Controllers;

use App\Models\Ortu;
use App\Models\Siswa;
use Illuminate\Http\Request;

class OrtuSiswaController extends Controller
{
    public function index(){
        
        $ortus = Ortu::with('siswas')->get();
        $siswas = Siswa::with('ortu')->get();

        return view('admin.dataortu.ortusiswa', compact('ortus', 'siswas'));
    }
}
