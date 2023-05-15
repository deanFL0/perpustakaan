<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramPerpustakaan;
use Kyslik\ColumnSortable\Sortable;
use PhpOffice\PhpWord\TemplateProcessor;
use Carbon\Carbon;

class ProgramPerpustakaanController extends Controller
{
    public function index(Request $request)
    {
        $program = ProgramPerpustakaan::sortable()->paginate(10)->onEachSide(2)->fragment('program');
        //get waktu kegiatan
        $waktu_kegiatan2 = ProgramPerpustakaan::selectRaw('MONTH(waktu_kegiatan) as month, YEAR(waktu_kegiatan) as year')->distinct()->orderBy('year', 'asc')->orderBy('month', 'asc')->get();

        // $years = ProgramPerpustakaan::selectRaw('YEAR(waktu_kegiatan) as year')->distinct()->orderBy('year', 'asc')->get();

        $year = $request->query('year');
        if (!empty($year)) {
            $program = ProgramPerpustakaan::sortable()->whereYear('waktu_kegiatan', $year)->paginate(10)->onEachSide(2)->fragment('program');
            return view('program.index', ['program' => $program, 'waktu_kegiatan' => $waktu_kegiatan2, 'year' => $year]);
        }

        $cari = $request->query('cari');
        if (!empty($cari)) {
            $program = ProgramPerpustakaan::sortable()
                ->where('program_perpustakaan.jenis_program', 'like', '%' . $cari . '%')
                ->orWhere('program_perpustakaan.jenis_kegiatan', 'like',  '%' . $cari . '%')
                ->orWhere('program_perpustakaan.waktu_kegiatan', 'like',  '%' . $cari . '%')
                ->orWhere('program_perpustakaan.keterangan', 'like',  '%' . $cari . '%')
                ->paginate(10)->onEachSide(2)->fragment('program');
        }

        return view('program.index', ['program' => $program, 'waktu_kegiatan' => $waktu_kegiatan2]);
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
        if ($request->waktu_selesai != null) {
            $waktu_selesai = $request->waktu_selesai;
            $waktu_selesai = date('Y-m-d', strtotime($waktu_selesai));
            $request->merge(['waktu_selesai' => $waktu_selesai]);
        } else {
            $request->merge(['waktu_selesai' => null]);
        }

        //turn array into string from jenis_kegiatan
        $jenis_kegiatan = $request->jenis_kegiatan;
        $jenis_kegiatan = implode(", ", $jenis_kegiatan);
        $request->merge(['jenis_kegiatan' => $jenis_kegiatan]);

        $request->validate([
            'jenis_program' => 'required',
            'jenis_kegiatan' => 'required',
            'waktu_kegiatan' => 'required',
            'waktu_selesai' => 'nullable',
            'keterangan' => 'nullable'
        ]);
        ProgramPerpustakaan::create($request->all());
        return redirect()->route('program');
    }

    public function edit($id)
    {
        $program = ProgramPerpustakaan::find($id);
        //get only month and year from waktu_kegiatan and waktu_selesai
        $program->waktu_kegiatan = date('Y-m', strtotime($program->waktu_kegiatan));
        if ($program->waktu_selesai != null) {
            $program->waktu_selesai = date('Y-m', strtotime($program->waktu_selesai));
        }

        return view('program.edit', ['program' => $program]);
    }

    public function update(Request $request)
    {
        $waktu_kegiatan = $request->waktu_kegiatan;
        $waktu_kegiatan = date('Y-m-d', strtotime($waktu_kegiatan));
        $request->merge(['waktu_kegiatan' => $waktu_kegiatan]);
        if ($request->waktu_selesai != null) {
            $waktu_selesai = $request->waktu_selesai;
            $waktu_selesai = date('Y-m-d', strtotime($waktu_selesai));
            $request->merge(['waktu_selesai' => $waktu_selesai]);
        } else {
            $request->merge(['waktu_selesai' => null]);
        }

        $jenis_kegiatan = $request->jenis_kegiatan;
        $jenis_kegiatan = implode(", ", $jenis_kegiatan);
        $request->merge(['jenis_kegiatan' => $jenis_kegiatan]);

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

    public function print(Request $request)
    {
        //export data with selected year to word
        $year = $request->query('year');
        $semester = $request->query('semester');
        $month1 = '';
        $month2 = '';
        if (!empty($year) && !empty($semester)) {
            $program = ProgramPerpustakaan::whereYear('waktu_kegiatan', $year)->get();
            //check if year contain S1 or S2
            if (strpos($semester, 'S1') !== false) {
                //get all data with year=$year and month=January to June
                $program = ProgramPerpustakaan::whereYear('waktu_kegiatan', $year)->whereMonth('waktu_kegiatan', '<=', 6)->get();
                $month1 = 'Januari';
                $month2 = 'Juni';
            } elseif (strpos($semester, 'S2') !== false) {
                //get all data with year=$year and month=July to December
                $program = ProgramPerpustakaan::whereYear('waktu_kegiatan', $year)->whereMonth('waktu_kegiatan', '>=', 7)->get();
                $month1 = 'Juli';
                $month2 = 'Desember';
            }

            $no = 1;
            $year = date('Y');
            //add 1 year to $year
            $year2 = date('Y', strtotime('+1 year', strtotime($year)));
            //export all data to word
            $templateProcessor = new TemplateProcessor('word_template/template.docx');
            $templateProcessor->cloneRow('jenis_program', count($program));
            $i = 1;
            //transform waktu_kegiatan date to F - Y format
            foreach ($program as $pro) {
                $pro->waktu_kegiatan = Carbon::parse($pro->waktu_kegiatan)->locale('id')->translatedFormat('F Y');
                if ($pro->waktu_selesai != null) {
                    $pro->waktu_selesai = Carbon::parse($pro->waktu_selesai)->translatedFormat('F Y');
                }
            }

            foreach ($program as $pro) {
                $templateProcessor->setValue('no#' . $i, $no++);
                $templateProcessor->setValue('jenis_program#' . $i, $pro->jenis_program);
                $templateProcessor->setValue('jenis_kegiatan#' . $i, $pro->jenis_kegiatan);
                $templateProcessor->setValue('waktu_kegiatan#' . $i, $pro->waktu_kegiatan);
                $templateProcessor->setValue('keterangan#' . $i, $pro->keterangan);
                $i++;
            }

            $templateProcessor->setValue('year', $year);
            $templateProcessor->setValue('year2', $year2);
            $templateProcessor->setValue('month1', $month1);
            $templateProcessor->setValue('month2', $month2);
            $filename = 'PROGRAM PERPUSTAKAAN SEKOLAH TAHUN ' . $year . '.docx';
            $templateProcessor->saveAs($filename);
            return response()->download($filename)->deleteFileAfterSend(true);
        } else {
            return redirect()->route('program')->with('error', 'Tahun tidak boleh kosong');
        }
    }
}
