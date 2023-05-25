<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class BukuController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $buku = Buku::paginate(20)->onEachSide(2)->fragment('buku');
      
        $cari = $request->query('cari');
        if (!empty($cari)) {
            $buku = Buku::
                where('judul', 'like', '%' . $cari . '%')
                ->orWhere('kelas', 'like',  '%' . $cari . '%')
                ->orWhere('pengarang', 'like',  '%' . $cari . '%')
                ->orWhere('penerbit', 'like',  '%' . $cari . '%')
                ->orWhere('tahunterbit', 'like',  '%' . $cari . '%')
                ->orWhere('jenisbuku', 'like',  '%' . $cari . '%')
                ->orWhere('jumlah', 'like',  '%' . $cari . '%')
                ->orWhere('kondisi', 'like',  '%' . $cari . '%')
                ->paginate(20)->onEachSide(2)->fragment('buku');
        } 
        return view('buku.index', ['buku' => $buku]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create()
    {
        return view('buku.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'kelas' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'tahunterbit' => 'required',
            'jenisbuku' => 'required',
            'jumlah' => 'required',
            'kondisi' => 'required',
        ]);
        $data = $request->except('_token');
        Buku::updateOrCreate([
            'id' => $request->id
        ], $data);
        // Buku::updateOrCreate(
        //     [
        //         'id' => $request->id
        //     ], [
        //         'judul' => $request->judul,
        //         'kelas' => $request->kelas,
        //         'pengarang' => $request->pengarang,
        //         'penerbit' => $request->penerbit,
        //         'tahunterbit' => $request->tahunterbit,
        //         'jenisbuku' => $request->jenisbuku,
        //         'jumlah' => $request->jumlah,
        //         'kondisi' => $request->kondisi,
        //     ]);
        return redirect()->route('buku');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        return view('buku.edit', ['buku' => $buku]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Buku::destroy($id);
    }
}