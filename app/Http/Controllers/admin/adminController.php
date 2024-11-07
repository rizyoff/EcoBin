<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class adminController extends Controller
{
    public function index(){
        $users = User::all();
        return view('admin.admin-dashboard',compact('users'));
    }


    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'usertype' => 'required|string',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'usertype' => $request->usertype,
        ]);

        return redirect()->route('admin.admin-dashboard')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $admin = User::findOrFail($id);

        return view('admin.edit', compact('admin'));
    }

    public function update(Request $request, User $users)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $users->id,
            'usertype' => 'required|string',
        ]);

        $users->update($request->only('name', 'email', 'usertype'));

        return redirect()->route('admin.admin-dashboard')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
         // Temukan user berdasarkan ID
         $user = User::findOrFail($id);

         // Hapus user
         $user->delete();

         // Redirect dengan pesan sukses
         return redirect()->route('admin.admin-dashboard')->with('success', 'User berhasil dihapus.');
        $users->delete();

    }
}
