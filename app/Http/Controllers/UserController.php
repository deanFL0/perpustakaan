<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function create()
    {
        return view('user.create');
    }

    public function store()
    {
        $data = request()->validate([
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required'
        ]);

        User::create($data);

        return redirect()->route('user.index');
    }

    public function edit(User $user)
    {
        return view('user.edit', ['user' => $user]);
    }

    public function update()
    {
        $data = request()->validate([
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::find(request()->id);
        $user->update($data);

        return redirect()->route('user.index');
    }

    public function destroy()
    {
        $user = User::find(request()->id);
        $user->delete();

        return redirect()->route('user.index');
    }
}
