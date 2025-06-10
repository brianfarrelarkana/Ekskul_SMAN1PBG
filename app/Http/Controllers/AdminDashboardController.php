<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $berita = Berita::where('user_id', Auth::id())->get();
        return view('admin_dashboard', compact('berita'));
    }
}
