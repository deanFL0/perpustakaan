<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramPerpustakaan;
use Termwind\Components\Dd;

class ProgramPerpustakaanController extends Controller
{
    public function index(Request $request)
    {
        $years = ProgramPerpustakaan::selectRaw('YEAR(waktu_kegiatan) as year')->distinct()->orderBy('year', 'asc')->get();

        $year = $request->query('year');
        if(!empty($year)){
            $program = ProgramPerpustakaan::sortable()->whereYear('waktu_kegiatan', $year)->paginate(10)->onEachSide(2)->fragment('program');
            return view('program.index', ['program' => $program, 'years' => $years]);
        }

        $cari = $request->query('cari');
        if (!empty($cari)) {
            $program = ProgramPerpustakaan::sortable()
                ->where('program_perpustakaan.jenis_program', 'like', '%' . $cari . '%')
                ->orWhere('program_perpustakaan.jenis_kegiatan', 'like',  '%' . $cari . '%')
                ->orWhere('program_perpustakaan.waktu_kegiatan', 'like',  '%' . $cari . '%')
                ->orWhere('program_perpustakaan.keterangan', 'like',  '%' . $cari . '%')
                ->paginate(10)->onEachSide(2)->fragment('program');
        } else {
            $program = ProgramPerpustakaan::sortable()->paginate(10)->onEachSide(2)->fragment('program');
        }
        return view('program.index', ['program' => $program, 'years' => $years]);
    }

    public function create()
    {
        return view('program.create');
    }

    public function store(Request $request)
    {

        // if ($request->waktu_selesai != null) {
        //     $waktu_selesai = $request->waktu_selesai;
        //     $waktu_selesai = date('F - Y', strtotime($waktu_selesai));
        //     $request->merge(['waktu_selesai' => $waktu_selesai]);

        //     $waktu_kegiatan = $request->waktu_kegiatan;
        //     $waktu_kegiatan = date('F - Y', strtotime($waktu_kegiatan));
        //     $request->merge(['waktu_kegiatan' => $waktu_kegiatan . ' sd ' . $waktu_selesai]);
        // } else {
        //     $waktu_kegiatan = $request->waktu_kegiatan;
        //     $waktu_kegiatan = date('F - Y', strtotime($waktu_kegiatan));
        //     $request->merge(['waktu_kegiatan' => $waktu_kegiatan]);
        // }

        //srttodate waktu_kegiatan dan waktu_selesai
        $waktu_kegiatan = $request->waktu_kegiatan;
        $waktu_kegiatan = date('Y-m-d', strtotime($waktu_kegiatan));
        $request->merge(['waktu_kegiatan' => $waktu_kegiatan]);
        if($request->waktu_selesai != null){
            $waktu_selesai = $request->waktu_selesai;
            $waktu_selesai = date('Y-m-d', strtotime($waktu_selesai));
            $request->merge(['waktu_selesai' => $waktu_selesai]);
        } else {
            $request->merge(['waktu_selesai' => null]);
        }

        $request->validate([
            'jenis_program' => 'required',
            'jenis_kegiatan' => 'required',
            'waktu_kegiatan' => 'required',
            'waktu_selesai' => 'nullable',
            'keterangan' => 'nullable'
        ]);
        @dd($request->all());
        ProgramPerpustakaan::create($request->all());
        return redirect()->route('program');
    }

    public function edit($id)
    {
        $program = ProgramPerpustakaan::find($id);
        //get only month and year from waktu_kegiatan and waktu_selesai
        $program->waktu_kegiatan = date('Y-m', strtotime($program->waktu_kegiatan));
        if($program->waktu_selesai != null){
            $program->waktu_selesai = date('Y-m', strtotime($program->waktu_selesai));
        }

        return view('program.edit', ['program' => $program]);
    }

    public function update(Request $request)
    {

        $data = $request->validate([
            'jenis_program' => 'required',
            'jenis_kegiatan' => 'required',
            'waktu_kegiatan' => 'required',
            'waktu_selesai' => 'nullable',
            'keterangan' => 'nullable',
        ]);
        $program = ProgramPerpustakaan::find($request->id);
        $program->update($data);
        return redirect()->route('program');
    }

    public function destroy($id)
    {
        ProgramPerpustakaan::destroy($id);
    }

    public function print(){

    }
}
