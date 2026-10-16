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
        $ortu = Ortu::paginate(7);
        // return response()->json($ortu);
        return view('admin/dataortu/index', compact('ortu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrtuRequest $request)
    {
        // Simpan data ke dalam database
        Ortu::create([
            'NIK_Orangtua' => $request->nik . "_" . $request->nama_ortu,
            'NIK' => $request->nik,
            'Nama' => $request->nama_ortu,
            'Alamat' => $request->alamat,
            'No_Telp' => $request->no_telp,
            'jk'    => $request->jk
        ]);
    
        return redirect()->route('/admin/dataortu/index')
            ->with('success', 'Data Orang Tua Berhasil Ditambahkan');

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
            'jk' => $dataortu -> jk,
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
        $dataortu ->jk = $request->jk;
        $dataortu ->save();

        return redirect()->route('/admin/dataortu/index')
            ->with('success', 'Data Orang Tua Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Ortu $ortu, $NIK_Orangtua)
    {
        $ortuhapus = $ortu->find($NIK_Orangtua);
        $ortuhapus->delete();
        return redirect()->route('/admin/dataortu/index')
            ->with('success', 'Data Orang Tua Berhasil Di Hapus');
    }

    public function search(Request $request)
    {
        $search = $request->search;
    
        $ortuSearch = Ortu::where('NIK_Orangtua', 'like', "%" . $search . "%")
        ->orWhere('NIK', 'like', "%" . $search . "%")
        ->orWhere('Nama', 'like', "%" . $search . "%")
        ->orWhere('Alamat', 'like', "%" . $search . "%")
        ->orWhere('No_Telp', 'like', "%" . $search . "%")
        ->orWhere('jk', 'like', "%" . $search . "%")
        ->paginate(7);
        
        
        return view('admin.dataortu.index', ['ortu' => $ortuSearch]);

    
    }

    public function detail(Ortu $ortu, $NIK_Orangtua)
    {
        // Find the parent record
        $ortuDetail = Ortu::with('siswas')->find($NIK_Orangtua);
    
        // Return the parent record along with the related data
        return response()->json($ortuDetail);
    }

}
