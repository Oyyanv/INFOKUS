<?php

namespace App\Http\Controllers;

use App\Models\Ortu;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOrtuRequest;
use App\Http\Requests\UpdateOrtuRequest;
use App\Http\Requests\UpdateSiswaRequest;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class OrtuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ortu = Ortu::all();
        // return response()->json($ortu);
        return view('admin/dataortu/index', compact('ortu'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     return view('admin/dataortu/create');
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrtuRequest $request)
    {
        $request->validate([
            'nik' => 'required|numeric',
            'nama_ortu' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required|numeric',
        ]);

        // Simpan data ke dalam database
        Ortu::create([
            'NIK_Orangtua' => $request->nik . "_" . $request->nama_ortu,
            'NIK' => $request->nik,
            'Nama' => $request->nama_ortu,
            'Alamat' => $request->alamat,
            'No_Telp' => $request->no_telp,
        ]);
    
        return redirect()->route('/admin/dataortu/index')
            ->with('success', 'Data Berhasil Ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(Ortu $ortu, $NIK_Orangtua)
    {
        $dataortu = $ortu->find($NIK_Orangtua);
        return view('/admin/dataortu/editortu')->with([
            'NIK_Orangtua' => $dataortu -> NIK_Orangtua,
            'nik' => $dataortu -> NIK,
            'nama_ortu' => $dataortu -> Nama,
            'alamat' => $dataortu -> Alamat,
            'no_telp' => $dataortu -> No_Telp,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrtuRequest $request, Ortu $ortu, $NIK_Orangtua)
    {
        $dataortu = $ortu->find($NIK_Orangtua);
        //yang kiri dari field data base
        //                          kanan field form editortu tadi ribet banget
        $dataortu ->NIK = $request->nik;
        $dataortu ->Nama = $request->nama_ortu;
        $dataortu ->Alamat = $request->alamat;
        $dataortu ->No_Telp = $request->no_telp;
        $dataortu ->save();

        return redirect()->route('/admin/dataortu/index')
            ->with('success', 'Orang Tua Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ortu $ortu)
    {
        $ortu->delete();
        return redirect()->route('admin/dataortu/index')
            ->with('Success', 'Orang Tua Berhasil Di Hapus');
    }
}
