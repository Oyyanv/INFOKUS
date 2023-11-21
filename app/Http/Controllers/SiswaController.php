<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;


class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = Siswa::all();
        return view('admin/datasiswa', compact('siswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('siswa/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'NIS_Kelas'=>'required|unique:siswas,NIS_Kelas',
            'NIK_Orangtua'=>'required|unique',
            'NIS'=>'required',
            'Nama'=>'required',
            'kelas'=>'required',
            'Jurusan'=>'required',
            'Angkatan'=>'required|numeric'
        ]);

        Siswa::create($request->all());
        return redirect()->route('siswa/index')
            ->with('Succes','Siswa Berhasil DiTambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa)
    {
        return view('siswa/show', compact('siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
    {
        return view('siswa/edit', compact('siswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'NIK_Orangtua'=>'required|unique',
            'NIS'=>'required',
            'Nama'=>'required',
            'kelas'=>'required',
            'Jurusan'=>'required',
            'Angkatan'=>'required|numeric'
        ]);

        $siswa -> update($request->all());
        return redirect()->route('siswa/index')
            ->with('Success','Siswa Berhasil DiTambahkan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
    {
        $siswa -> delete();

        return redirect()->route('siswa/index')
         ->with('Success','Siswa Berhasil Di Hapus');
    }
}
