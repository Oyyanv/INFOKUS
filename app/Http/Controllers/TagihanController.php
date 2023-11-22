<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use Illuminate\Http\Request;

class TagihanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tagihan = Tagihan::all();
        return response()->json($tagihan);
        return view('admin/datasiswa/index', compact('tagihan'));
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
            'id_tagihan' => 'required|unique:tagihans,id_tagihan',
            'bulan' => 'required',
            'tagihan' => 'required',
        ]);

        Tagihan::create($request->all());
        return redirect()->route('admin/datasiswa/index')
            ->with('Success', 'Tagihan Berhasil DiTambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tagihan $tagihan)
    {
        return view('admin/datasiswa/show', compact('tagihan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tagihan $tagihan)
    {
        return view('admin/datasiswa/edit', compact('tagihan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tagihan $tagihan)
    {

        $request->validate([
            'bulan' => 'required',
            'tagihan' => 'required',
        ]);

        $tagihan->update($request->all());
        return redirect()->route('admin/datasiswa/index')
            ->with('Success', 'Tagihan Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tagihan $tagihan)
    {
        $tagihan->delete();

        return redirect()->route('admin/datasiswa/index')
            ->with('Success', 'Tagihan Berhasil Di Hapus');
    }
}
