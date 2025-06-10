<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Facades\Auth;

class BeritaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $berita = Berita::where('user_id', $user->id)->latest()->get();
        return view($user->role == 'superadmin' ? 'superadmin_berita' : 'admin_berita', compact('berita', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        Berita::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'user_id' => Auth::id(),
        ]);

        return back()->with('success', 'Berita berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        if ($berita->user_id != Auth::id()) {
            abort(403);
        }

        $berita->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
        ]);

        return response()->json(['message' => 'Berita diperbarui.']);
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        if ($berita->user_id != Auth::id()) {
            abort(403);
        }

        $berita->delete();

        return response()->json(['message' => 'Berita dihapus.']);
    }
}
