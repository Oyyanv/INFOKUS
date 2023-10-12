<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Contracts\Validation\ValidationRule;


class SessionController extends Controller
{
    function index(){
        return view('sesi/login');
    }

    function login(Request $request){
        
        $request->validate(
        [
            'email' => ['required', 'email', new \App\Rules\EmailValidation],
            'password' => ['required'],
        ], 
        [
            'email.required' => 'Email wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);
        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        $request->session()->put('login_email', $request->email);
        $user = User::where('email', $request->email)->first();

    if ($user) {
        // User exists in the database
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication successful
            if ($user->status == 'admin') {
                return redirect('dashboard/admin')->with('success', 'Anda berhasil login!');
                $request->session()->forget('login_email');
            } elseif ($user->status == 'siswa') {
                return redirect('dashboard/siswa')->with('success', 'Anda berhasil login!');
                $request->session()->forget('login_email');
            }
        } else {
            // Authentication failed (password incorrect)
            return redirect()->back()->with('error', 'Password yang Anda masukkan salah!');
        }
    } else {
        // User does not exist
        return redirect()->back()->with('error', 'Email atau password tidak terdaftar!');
        $request->session()->forget('login_email');
    }
}
  
       function logout(){
        Auth::logout();
        return redirect('login');
    }
}