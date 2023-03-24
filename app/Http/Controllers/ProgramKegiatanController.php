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
}
