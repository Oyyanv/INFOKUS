<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Ortu;
use Illuminate\Http\Request;

class OrtuSiswaController extends Controller
{
    public function index($NIK_Orangtua){
        
        $siswa = Siswa::with('ortu')->find($NIK_Orangtua);
        return view('/admin/datasiswa/detailsiswa', compact('siswa'));
    }
}
