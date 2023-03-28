<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramKegiatan;

class ProgramKegiatanController extends Controller
{
    public function index()
    {
        $prokeg = ProgramKegiatan::all();
        return view('prokeg.index', ['prokeg' => $prokeg]);
    }

    public function create()
    {
        return view('prokeg.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'status' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
        ]);

        ProgramKegiatan::create($data);

        return redirect()->route('prokeg.index');
    }

    public function edit(ProgramKegiatan $prokeg)
    {
        return view('prokeg.edit', ['prokeg' => $prokeg]);
    }

    public function update()
    {
        $data = request()->validate([
            'nama' => 'required',
            'kode' => 'required',
            'jenis' => 'required'
        ]);

        $prokeg = ProgramKegiatan::find(request()->id);
        $prokeg->update($data);

        return redirect()->route('prokeg.index');
    }

    public function destroy()
    {
        $prokeg = ProgramKegiatan::find(request()->id);
        $prokeg->delete();

        return redirect()->route('prokeg.index');
    }
}
