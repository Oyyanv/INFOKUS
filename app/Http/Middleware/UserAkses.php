<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use illuminate\Support\Facades\Auth;

class UserAkses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $status): Response
    {
        if (Auth()->user()->status == $status){
            return $next($request);
        }
        if(Auth::user()->status == 'admin'){
            return redirect('dashboard/admin');
        }elseif (Auth::user()->status == 'siswa')
            return redirect('dashboard/siswa');
    }
}
