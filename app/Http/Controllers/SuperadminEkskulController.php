<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SuperadminEkskulController extends Controller
{
    public function index()
    {
        $admins = User::where('role', 'admin')->get();
        return view('superadmin_ekskul', compact('admins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        return redirect()->back()->with('success', 'Admin berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $admin = User::findOrFail($id);
        if ($admin->role === 'admin') {
            $admin->delete();
        }
        return redirect()->back()->with('success', 'Admin berhasil dihapus.');
    }
}
