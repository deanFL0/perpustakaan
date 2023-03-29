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
            'nama_program' => 'required',
            'status' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
        ]);

        ProgramKegiatan::create($data);

        return redirect()->route('prokeg');
    }

    public function edit($id)
    {
        $prokeg = ProgramKegiatan::find($id);
        return view('prokeg.edit', ['prokeg' => $prokeg]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'nama_program' => 'required',
            'status' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
        ]);

        $prokeg = ProgramKegiatan::find(request()->id);
        $prokeg->update($data);

        return redirect()->route('prokeg');
    }

    public function destroy($id)
    {
        ProgramKegiatan::destroy($id);
    }
}
