<?php

namespace App\Http\Controllers;

use App\Models\Gurustaff;
use Illuminate\Http\Request;

class GurustaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guru = Gurustaff::all();
        return response()->json($guru);
        return view('admin/datasiswa/index', compact('guru'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin/datasiswa/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'NIP'=>'requidred|unique:gurustaffs,NIP',
            'nama'=>'required',
            'status'=>'required'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Gurustaff $guru)
    {
        return view('admin/datasiswa/show', compact('guru'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gurustaff $guru)
    {
        return view('admin/datasiswa/edit', compact('guru'));  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gurustaff $guru)
    {
        $request->validate([
            'nama'=>'required',
            'status'=>'required'
        ]); 

        $guru ->update($request->all());
        return redirect()->route('admin/datasiswa/index')
            ->with('Success','Guru/Staff Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gurustaff $guru)
    {
        $guru -> delete();

        return redirect()->route('admin/datasiswa/index')
         ->with('Success','Guru/Staff Berhasil Di Hapus');
    }
}
