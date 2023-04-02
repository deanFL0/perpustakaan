<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramKegiatan;
use PhpOffice\PhpWord\TemplateProcessor;

class ProgramKegiatanController extends Controller
{
    public function index()
    {
        $prokeg = ProgramKegiatan::sortable()->paginate(10)->onEachSide(2)->fragment('prokeg');
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

    public function print()
    {
        $prokeg = ProgramKegiatan::all();

        //export all data to word
        $templateProcessor = new TemplateProcessor('word_template/template.docx');
        $templateProcessor->cloneRow('nama_program', count($prokeg));
        $i = 1;
        foreach ($prokeg as $prokeg) {
            $templateProcessor->setValue('nama_program#' . $i, $prokeg->nama_program);
            $templateProcessor->setValue('status#' . $i, $prokeg->status);
            $templateProcessor->setValue('tanggal_mulai#' . $i, $prokeg->tanggal_mulai);
            $templateProcessor->setValue('tanggal_selesai#' . $i, $prokeg->tanggal_selesai);
            $i++;
        }
        $filename = 'Program Kegiatan.docx';
        $templateProcessor->saveAs($filename);
        return response()->download($filename)->deleteFileAfterSend(true);
    }
}
