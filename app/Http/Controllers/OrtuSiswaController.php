<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Ortu;
use Illuminate\Http\Request;

class OrtuSiswaController extends Controller
{
    public function index(){
        
        $ortus = Ortu::with('siswas')->get();
        $siswas = Siswa::with('ortu')->get();

        return view('admin.dataortu.ortusiswa', compact('ortus', 'siswas'));
    }
}
