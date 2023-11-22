<?php

namespace App\Http\Controllers;

use App\Models\Ortu;
use Illuminate\Http\Request;

class OrtuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ortu = Ortu::all();
        return response()->json($ortu);
        return view('admin/datasiswa/index', compact('ortu'));
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
            'NIK_Orangtua' => 'required|unique:orangtua,NIK_Orangtua',
            'Nama' => 'required',
            'Alamat' => 'required',
            'No_Telp' => 'required']);

        Ortu::create($request->all());
        return redirect()->route('admin/datasiswa/index')
            ->with('Success', 'Orang Tua Berhasil DiTambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(Ortu $ortu)
    {
        return view('admin/datasiswa/show', compact('ortu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin/datasiswa/edit', compact('ortu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ortu $ortu)
    {
        $request->validate([
            'Nama' => 'required',
            'Alamat' => 'required',
            'No_Telp' => 'required']);

        $ortu->update($request->all());
        return redirect()->route('admin/datasiswa/index')
            ->with('Success', 'Orang Tua Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ortu $ortu)
    {
        $ortu->delete();
        return redirect()->route('admin/datasiswa/index')
            ->with('Success', 'Orang Tua Berhasil Di Hapus');
    }
}
