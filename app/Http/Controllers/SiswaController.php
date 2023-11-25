<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSiswaRequest;
use App\Http\Requests\UpdateSiswaRequest;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;


class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = Siswa::all();
        return view('admin.datasiswa.index', compact('siswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
   

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSiswaRequest $request)
    {
        $request->validate([
            'NIS' => 'required',
            'Nama' => 'required',
            'kelas' => 'required',
            'Jurusan' => 'required',
            'Angkatan' => 'required|numeric',
        ]);
    
        // Simpan data ke dalam database
        Siswa::create([
            'NIS_Kelas' => $request->NIS . "_" . $request->kelas,
            'NIS' => $request->NIS,
            'Nama' => $request->Nama,
            'kelas' => $request->kelas,
            'Jurusan' => $request->Jurusan,
            'Angkatan' => $request->Angkatan,
        ]);
    
        return redirect()->route('admin/datasiswa/index')
            ->with('success', 'Siswa Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa)
    {

        return view('admin/datasiswa/show', compact('siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
    {
        return view('admin/datasiswa/edit', compact('siswa'));
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
        return redirect()->route('admin/datasiswa/index')
            ->with('Success','Siswa Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
    {
        $siswa -> delete();

        return redirect()->route('admin/datasiswa/index')
         ->with('Success','Siswa Berhasil Di Hapus');
    }
}
