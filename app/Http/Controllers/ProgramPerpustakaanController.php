<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramPerpustakaan;
use App\Models\JenisKegiatan;
use Kyslik\ColumnSortable\Sortable;
use PhpOffice\PhpWord\TemplateProcessor;
use Carbon\Carbon;

class ProgramPerpustakaanController extends Controller
{
    public function index(Request $request)
    {
        $program = ProgramPerpustakaan::with('jenisKegiatan')->sortable()->paginate(10)->onEachSide(2)->fragment('program');

        //get waktu kegiatan
        $waktu_kegiatan = ProgramPerpustakaan::selectRaw('MONTH(waktu_kegiatan) as month, YEAR(waktu_kegiatan) as year')->distinct()->orderBy('year', 'asc')->orderBy('month', 'asc')->get();

        // $years = ProgramPerpustakaan::selectRaw('YEAR(waktu_kegiatan) as year')->distinct()->orderBy('year', 'asc')->get();

        $year = $request->query('year');
        if (!empty($year)) {
            $program = ProgramPerpustakaan::with('jenisKegiatan')->sortable()->whereYear('waktu_kegiatan', $year)->paginate(10)->onEachSide(2)->fragment('program');
            return view('program.index', ['program' => $program, 'waktu_kegiatan' => $waktu_kegiatan, 'year' => $year]);
        }

        $cari = $request->query('cari');
        if (!empty($cari)) {
            $program = ProgramPerpustakaan::with('jenisKegiatan')->sortable()
                ->where('program_perpustakaan.jenis_program', 'like', '%' . $cari . '%')
                ->orWhere('program_perpustakaan.waktu_kegiatan', 'like',  '%' . $cari . '%')
                ->orWhere('program_perpustakaan.keterangan', 'like',  '%' . $cari . '%')
                ->orWhereHas('jenisKegiatan', function ($query) use ($cari) {
                    $query->where('nama_kegiatan', 'like', '%' . $cari . '%');
                })
                ->paginate(10)->onEachSide(2)->fragment('program');
            $jenis_kegiatan = JenisKegiatan::sortable()->where('nama_kegiatan', 'like', '%' . $cari . '%')->paginate(10)->onEachSide(2)->fragment('nama_kegiatan');
        }

        return view('program.index', ['program' => $program, 'waktu_kegiatan' => $waktu_kegiatan]);
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

        $request->validate([
            'jenis_program' => 'required',
            'waktu_kegiatan' => 'required',
            'waktu_selesai' => 'nullable',
            'keterangan' => 'nullable'
        ]);
        $program = ProgramPerpustakaan::create($request->all());

        //turn array into string from jenis_kegiatan
        $jenis_kegiatan = $request->jenis_kegiatan;
        $jenis_kegiatan = implode(", ", $jenis_kegiatan);

        for ($i = 0; $i < count($request->jenis_kegiatan); $i++) {
            $jenis_kegiatan = $request->jenis_kegiatan[$i];
            $jenis_kegiatan = JenisKegiatan::create([
                'program_perpustakaan_id' => $program->id,
                'nama_kegiatan' => $jenis_kegiatan
            ]);
        }

        return redirect()->route('program');
    }

    public function edit($id)
    {
        $program = ProgramPerpustakaan::with('jenisKegiatan')->find($id);
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

        $data = $request->validate([
            'jenis_program' => 'required',
            'waktu_kegiatan' => 'required',
            'waktu_selesai' => 'nullable',
            'keterangan' => 'nullable',
        ]);

        $program = ProgramPerpustakaan::find($request->id);
        $program->update($data);
        //also update jenis kegiatan
        $jenis_kegiatan = $program->jenisKegiatan;
        //delete all jenis kegiatan and create new one
        foreach ($jenis_kegiatan as $jenis) {
            $jenis->delete();
        }

        for ($i = 0; $i < count($request->jenis_kegiatan); $i++) {
            $jenis_kegiatan = $request->jenis_kegiatan[$i];
            $jenis_kegiatan = JenisKegiatan::create([
                'program_perpustakaan_id' => $program->id,
                'nama_kegiatan' => $jenis_kegiatan
            ]);
        }

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
            $program = ProgramPerpustakaan::whereYear('waktu_kegiatan', $year)->with('jenisKegiatan')->get();
            //check if year contain S1 or S2
            if (strpos($semester, 'S1') !== false) {
                //get all data with year=$year and month=July to December
                $program = ProgramPerpustakaan::whereYear('waktu_kegiatan', $year)->whereMonth('waktu_kegiatan', '>=', 7)->with('jenisKegiatan')->get();
                $month1 = 'Juli';
                $month2 = 'Desember';
            } elseif (strpos($semester, 'S2') !== false) {
                //get all data with year=$year and month=January to June
                $program = ProgramPerpustakaan::whereYear('waktu_kegiatan', $year)->whereMonth('waktu_kegiatan', '<=', 6)->with('jenisKegiatan')->get();
                $month1 = 'Januari';
                $month2 = 'Juni';
            }

            $no = 1;
            $years = $year;
            $years2 = $years;
            $years3 = $years;
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
                //with phpword, make ordered list for jenis kegiatan column
                $templateProcessor->setValue('jenis_kegiatan#' . $i, $pro->jenisKegiatan->map(function ($item, $key) {
                    return $key + 1 . '. ' . $item->nama_kegiatan . '<w:br/>';
                })->implode("\n"));
                if ($pro->waktu_selesai != null) {
                    $templateProcessor->setValue('waktu_kegiatan#' . $i, $pro->waktu_kegiatan . ' s/d ' . $pro->waktu_selesai);
                } else {
                    $templateProcessor->setValue('waktu_kegiatan#' . $i, $pro->waktu_kegiatan);
                }
                $templateProcessor->setValue('keterangan#' . $i, $pro->keterangan);
                $i++;
            }

            if ($semester == 'S1') {
                $semester = 'semester 1';
                $years3 = $years + 1;
            } elseif ($semester == 'S2') {
                $semester = 'semester 2';
                $years2 = $years - 1;
            }

            $templateProcessor->setValue('semester', $semester);
            $templateProcessor->setValue('year', $years);
            $templateProcessor->setValue('month1', $month1);
            $templateProcessor->setValue('month2', $month2);
            $templateProcessor->setValue('year2', $years2);
            $templateProcessor->setValue('year3', $years3);

            $filename = 'PROGRAM PERPUSTAKAAN SEKOLAH TAHUN ' . $years . '.docx';
            $templateProcessor->saveAs($filename);
            return response()->download($filename)->deleteFileAfterSend(true);
        } else {
            return redirect()->route('program')->with('error', 'Tahun tidak boleh kosong');
        }
    }
}
