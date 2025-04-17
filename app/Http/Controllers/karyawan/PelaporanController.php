<?php

namespace App\Http\Controllers\karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelaporan;
use Illuminate\Support\Facades\Auth;

class PelaporanController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id_user;
    
        $pelaporans = Pelaporan::with('user')
                        ->where('user_id', $userId)
                        ->orderBy('tanggal_pelaporan', 'desc')
                        ->paginate(10); 
    
        return view('karyawan.pelaporanTable', compact('pelaporans'));
    }

    public function create()
    {
        return view('karyawan.pelaporanAdd');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_pelaporan' => 'required|date',
            'aktivitas' => 'required|string',
            'keterangan' => 'required|string',
        ]);

            // Cek apakah user sudah melaporkan pada tanggal yang sama
    $konflik = Pelaporan::where('user_id', Auth::user()->id_user)
    ->whereDate('tanggal_pelaporan', $request->tanggal_pelaporan)
    ->exists();

if ($konflik) {
return redirect()->back()->withErrors(['tanggal_pelaporan' => 'Anda sudah melaporkan kegiatan pada tanggal ini.'])->withInput();
}

        Pelaporan::create([
            'tanggal_pelaporan' => $request->tanggal_pelaporan,
            'aktivitas' => $request->aktivitas,
            'keterangan' => $request->keterangan,
            'user_id' => Auth::user()->id_user,
            'status' => 'proses',
        ]);

        return redirect()->route('karyawan.pelaporanTable')->with('success', 'Pelaporan berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $pelaporan = Pelaporan::with('user')->findOrFail($id);
        return view('admin.pelaporanShow', compact('pelaporan'));
    }

    public function edit(string $id)
    {
        $pelaporan = Pelaporan::findOrFail($id);
        return view('karyawan.pelaporanEdit', compact('pelaporan'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'tanggal_pelaporan' => 'required|date',
            'aktivitas' => 'required|string',
            'keterangan' => 'required|string',
        ]);

        $pelaporan = Pelaporan::findOrFail($id);
        $pelaporan->update([
            'tanggal_pelaporan' => $request->tanggal_pelaporan,
            'aktivitas' => $request->aktivitas,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('karyawan.pelaporanTable')->with('success', 'Pelaporan berhasil diupdate');
    }

    public function destroy(string $id)
    {
        $pelaporan = Pelaporan::findOrFail($id);
        $pelaporan->delete();

        return redirect()->route('karyawan.pelaporanTable')->with('success', 'Pelaporan berhasil dihapus');
    }


}
