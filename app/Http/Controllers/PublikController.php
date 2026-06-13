<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\KategoriArtikel;

class PublikController extends Controller
{
    public function index(Request $request)
    {
        //HALAMAN UTAMA
        $kategori = KategoriArtikel::withCount('artikel')->get();

        $query = Artikel::with('penulis', 'kategori')
            ->orderBy('id', 'desc');

        // Filter berdasarkan kategori jika ada
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('id_kategori', $request->kategori);
        }

        $artikel = $query->take(5)->get();

        $kategoriAktif = $request->kategori ?? null;

        return view('publik.index', compact('artikel', 'kategori', 'kategoriAktif'));
    }

    //HALAMAN DETAIL ARTIKEL
    public function show($id)
    {
        $artikel = Artikel::with('penulis', 'kategori')->findOrFail($id);

        // 5 artikel terkait dari kategori yang sama, kecuali artikel ini
        $artikelTerkait = Artikel::with('penulis', 'kategori')
            ->where('id_kategori', $artikel->id_kategori)
            ->where('id', '!=', $artikel->id)
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();

        return view('publik.show', compact('artikel', 'artikelTerkait'));
    }
}
