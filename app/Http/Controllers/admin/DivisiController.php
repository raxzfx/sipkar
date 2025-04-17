<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Divisi;

class DivisiController extends Controller
{
    // Tampilkan semua data divisi
    public function index()
    {
        $divisis = Divisi::paginate(10);
        return view('admin.divisiTable', compact('divisis'));
    }

    // Tampilkan form tambah divisi
    public function create()
    {
        return view('admin.divisiAdd');
    }

    // Simpan data divisi baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_divisi' => 'required|unique:divisi,nama_divisi',
        ]);

        Divisi::create([
            'nama_divisi' => $request->nama_divisi,
        ]);

        return redirect()->route('admin.divisiTable')->with('success', 'Divisi berhasil ditambahkan.');
    }

    // Tampilkan form edit divisi
    public function edit(string $id)
    {
        $divisi = Divisi::findOrFail($id);
        return view('admin.divisiEdit', compact('divisi'));
    }

    // Update data divisi
    public function update(Request $request, string $id)
    {
        $divisi = Divisi::findOrFail($id);

        $request->validate([
            'nama_divisi' => 'required|unique:divisi,nama_divisi,' . $id . ',id_divisi',
        ]);

        $divisi->update([
            'nama_divisi' => $request->nama_divisi,
        ]);

        return redirect()->route('admin.divisiTable')->with('success', 'Divisi berhasil diperbarui.');
    }

    // Hapus data divisi
    public function destroy(string $id)
    {
        $divisi = Divisi::findOrFail($id);
        $divisi->delete();

        return redirect()->route('admin.divisiTable')->with('success', 'Divisi berhasil dihapus.');
    }
}
