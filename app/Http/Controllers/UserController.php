<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::paginate(7);
        return view('admin/datauser/index', compact('user'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function search(Request $request)
    {
        $search = $request->search;
    
        $userSearch = User::where('id_user', 'like', "%" . $search . "%")
        ->orWhere('email', 'like', "%" . $search . "%")
        ->orWhere('status', 'like', "%" . $search . "%")
        ->paginate(7);
        
        
        return view('admin.datauser.index', ['user' => $userSearch]);

    
    }

}
