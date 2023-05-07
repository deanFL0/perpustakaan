<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ProgramPerpustakaan as Program;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::count();
        $program = Program::count();
        return view('dashboard.index', compact('user', 'program'));
    }
}
