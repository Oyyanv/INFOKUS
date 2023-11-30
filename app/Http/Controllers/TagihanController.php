<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTagihanRequest;
use App\Http\Requests\UpdateTagihanRequest;
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
        return view('admin/datatagihan/index', compact('tagihan'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTagihanRequest $request)
    {
        // Simpan data ke dalam database
        Tagihan::create([
            'tagihan' => $request->tagihan,
            'bulan' => $request->bulan
        ]);
        return redirect()->route('/admin/datatagihan/index')
            ->with('success', 'Data Tagihan Berhasil DiTambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tagihan $tagihan ,$id_tagihan)
    {
        $datatagihan = $tagihan->find($id_tagihan);
        return view('/admin/datatagihan/edittagihan')->with([
            'id_tagihan' => $datatagihan ->id_tagihan,
            'tagihan' => $datatagihan ->tagihan,
            'bulan' => $datatagihan-> bulan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagihanRequest $request, Tagihan $tagihan, $id_tagihan)
    {
        $updatetagihan = $tagihan->find($id_tagihan);
        //yang kiri dari field data base
        //                          kanan field form editortu tadi ribet banget
        $updatetagihan ->tagihan = $request->tagihan;
        $updatetagihan ->bulan = $request->bulan;
        $updatetagihan ->save();

        return redirect()->route('/admin/datatagihan/index')
            ->with('success', 'Data Tagihan Berhasil Di Update'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Tagihan $tagihan, $id_tagihan)
    {
        $hapustagihan = $tagihan->find($id_tagihan);
        $hapustagihan->delete();

        return redirect()->route('/admin/datatagihan/index')
            ->with('success', 'Tagihan Berhasil Di Hapus');
    }
}
