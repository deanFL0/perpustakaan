<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $user = User::all();

        $cari = $request->query('cari');
        if (!empty($cari)) {
            $user = User::where('nama', 'like', '%' . $cari . '%')
                ->orWhere('role', 'like',  '%' . $cari . '%')
                ->orWhere('username', 'like',  '%' . $cari . '%')
                ->paginate(10)->onEachSide(2)->fragment('user');
        } else {
            $user = User::paginate(10)->onEachSide(2)->fragment('user');
        }

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

    public function edit($id)
    {
        $user = User::find($id);
        return view('user.edit', ['user' => $user]);
    }

    public function update(Request $request)
    {
        $user = User::find(request()->id);

        $data = $request->validate([
            'nama' => 'required',
            'role' => 'required',
            'username' => 'required',
            'password' => 'required'
        ]);
        //if password doesn't change dont store it
        if ($data['password'] == $user->password) {
            unset($data['password']);
        } else {
            $data['password'] = bcrypt($data['password']);
        }


        $user = User::find(request()->id);
        $user->update($data);

        return redirect()->route('user');
    }

    public function destroy($id)
    {
        User::destroy($id);
    }
}
