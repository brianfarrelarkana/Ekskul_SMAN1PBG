<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\JadwalEkskul;
use App\Models\AdminProfile;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $jadwal = JadwalEkskul::with('profile')->get()->groupBy('hari')->map(function ($items, $hari) {
            return [
                'hari' => $hari,
                'kegiatan' => $items->map(function ($j) {
                    return [
                        'nama' => $j->profile->nama_ekskul ?? 'Ekskul',
                        'waktu' => \Carbon\Carbon::parse($j->waktu_mulai)->format('H:i') . ' - ' . \Carbon\Carbon::parse($j->waktu_selesai)->format('H:i'),
                    ];
                })->values()
            ];
        })->values();

        $berita = Berita::latest()->get();

        return view('index', compact('jadwal', 'berita'));
    }

    public function jadwalJson()
    {
        $jadwal = JadwalEkskul::with('profile')->get()->groupBy('hari')->map(function ($items, $hari) {
            return [
                'hari' => $hari,
                'kegiatan' => $items->map(function ($j) {
                    return [
                        'nama' => $j->profile->nama_ekskul ?? 'Ekskul',
                        'waktu' => \Carbon\Carbon::parse($j->waktu_mulai)->format('H:i') . ' - ' . \Carbon\Carbon::parse($j->waktu_selesai)->format('H:i'),
                    ];
                })->values()
            ];
        })->values();

        return response()->json($jadwal);
    }

    public function daftarEkskul()
    {
        $profiles = AdminProfile::with(['jadwal', 'galeri'])->get();

        return view('daftar_ekskul', compact('profiles'));
    }

    public function showEkskul($id)
    {
        $profile = AdminProfile::with(['jadwal', 'galeri'])->findOrFail($id);

        return view('ekskul', compact('profile'));
    }
}
