<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ProgramPerpustakaan as Program;
use App\Models\Buku;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::count();
        $program = Program::count();
        $buku = Buku::count();
        return view('dashboard.index', compact('user', 'program', 'buku'));
    }
}
