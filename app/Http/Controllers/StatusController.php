<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
{
    function index(){
        echo "<h1>selamat datang admin</h1>";
    }
}
