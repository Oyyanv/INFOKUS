<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
class UpdatePasswordController extends Controller
{
    public function edit(){
        return view('profile.password.edit');
    
    }
    public function update(Request $request){
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed'],
        ]);
    
        $user = auth()->user();
    
        if (Hash::check($request->current_password, $user->password)){

            if (!Hash::check($request->password, $user->password)){
    
                $user->update(['password' => Hash::make($request->password)]);
    
                return redirect('/dashboard')->with('success', 'Kata sandi anda berhasil terubah!');
            } else {
                throw ValidationException::withMessages([
                    'password' => 'Kata sandi baru tidak boleh sama dengan kata sandi lama Anda.',
                ]);
            }
        }
    
        throw ValidationException::withMessages([
            'current_password' => 'Kata sandi yang Anda masukkan tidak sama.',
        ]);
    }
    
    } 
