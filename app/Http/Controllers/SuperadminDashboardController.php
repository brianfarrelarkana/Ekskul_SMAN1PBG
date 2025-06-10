<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SuperadminDashboardController extends Controller
{
    public function index()
    {
        $jumlahEkskul = User::where('role', 'admin')->count();
        $admins = User::with('profile')->where('role', 'admin')->get();

        return view('superadmin_dashboard', compact('jumlahEkskul', 'admins'));
    }
}
