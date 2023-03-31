<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('user.index', ['user' => $user]);
    }

    public function create()
    {
        return view('user.create');
    }

    public function store()
    {
        $data = request()->validate([
            'nama' => 'required',
            'role' => 'required',
            'username' => 'required',
            'password' => 'required'
        ]);

        $data['password'] = bcrypt($data['password']);

        User::create($data);

        return redirect()->route('user');
    }

    public function edit(User $user)
    {
        return view('user.edit', ['user' => $user]);
    }

    public function update($id)
    {
        $data = request()->validate([
            'nama' => 'required',
            'role' => 'required',
            'username' => 'required',
            'password' => 'required'
        ]);
        $data['password'] = bcrypt($data['password']);

        $user = User::find($id);
        $user->update($data);

        return redirect()->route('user');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('user');
    }
}
