<?php

namespace App\Http\Controllers\tim;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    // Menampilkan semua kategori
    public function index()
    {
        $kategoris = Kategori::paginate(10); // Menggunakan paginate
        return view('tim.kategoriTable', compact('kategoris'));
    }

    // Menampilkan form tambah
    public function create()
    {
        return view('tim.kategoriAdd');
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'nilai' => 'required|numeric',
        ]);

        Kategori::create($request->all());

        return redirect()->route('tim.kategoriTable')->with('success', 'Kategori berhasil ditambahkan');
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('tim.kategoriEdit', compact('kategori'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'nilai' => 'required|numeric',
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update($request->all());

        return redirect()->route('tim.kategoriTable')->with('success', 'Kategori berhasil diupdate');
    }

    // Hapus data
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route('tim.kategoriTable')->with('success', 'Kategori berhasil dihapus');
    }
}
