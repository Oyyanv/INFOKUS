<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
  function datashow (){
        $siswa = Siswa::all();
        return response()->json($siswa);
  }  
}
