<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminProfile;
use App\Models\JadwalEkskul;
use App\Models\GaleriFoto;

class ProfileController extends Controller
{
    public function show()
    {
        $profile = AdminProfile::with(['jadwal', 'galeri'])
            ->where('user_id', auth()->id())
            ->first();

        if (!$profile) {
            $profile = AdminProfile::create([
                'user_id' => auth()->id(),
                'nama_ekskul' => '',
                'deskripsi' => '',
                'link_youtube' => '',
                'avatar' => null,
                'banner' => null,
            ]);
        }

        return view('admin_profile', compact('profile'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_ekskul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'link_youtube' => 'nullable|url',
            'hari' => 'required|string|max:20',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'banner' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'galeri_1' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'galeri_2' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'galeri_3' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);
 
        $profile = AdminProfile::firstOrNew(['user_id' => auth()->id()]);
        $profile->nama_ekskul = $request->nama_ekskul;
        $profile->deskripsi = $request->deskripsi;
        $profile->link_youtube = $request->link_youtube;
 
        foreach (['avatar', 'banner'] as $img) {
            if ($request->hasFile($img)) {
                $filename = $request->file($img)->store('profiles', 'public');
                $profile->$img = $filename;
            }
        }
 
        $profile->save();

        JadwalEkskul::updateOrCreate(
            ['user_id' => $profile->user_id],
            [
                'hari' => $request->hari,
                'waktu_mulai' => $request->waktu_mulai,
                'waktu_selesai' => $request->waktu_selesai
            ]
        );

        GaleriFoto::where('user_id', $profile->user_id)->delete();

        foreach (['galeri_1', 'galeri_2', 'galeri_3'] as $key) {
            if ($request->hasFile($key)) {
                $path = $request->file($key)->store('galeri', 'public');
                GaleriFoto::create([
                    'user_id' => $profile->user_id,
                    'path' => $path
                ]);
            }
        }

        return back()->with('success', 'Profil berhasil disimpan!');
    }
}
