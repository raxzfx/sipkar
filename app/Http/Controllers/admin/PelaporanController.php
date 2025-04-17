<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelaporan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PelaporanController extends Controller
{
    public function index()
    {
        $pelaporans = Pelaporan::with('user')->latest()->paginate(10);
        return view('admin.pelaporanTable', compact('pelaporans'));
    }

    public function create()
    {
        $users = User::where('jabatan', 'karyawan')->get();
        return view('admin.pelaporanAdd',compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
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
            'user_id' => $request->user_id,
            'status' => 'proses',
        ]);

        return redirect()->route('admin.pelaporanTable')->with('success', 'Pelaporan berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $pelaporan = Pelaporan::with('user')->findOrFail($id);
        return view('admin.pelaporanShow', compact('pelaporan'));
    }

    public function edit(string $id)
    {
        $pelaporan = Pelaporan::findOrFail($id);
        return view('admin.pelaporanEdit', compact('pelaporan'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'tanggal_pelaporan' => 'required|date',
            'aktivitas' => 'required|string',
            'keterangan' => 'required|string',
            'status' => 'required|in:proses,selesai',
        ]);

        $pelaporan = Pelaporan::findOrFail($id);
        $pelaporan->update([
            'tanggal_pelaporan' => $request->tanggal_pelaporan,
            'aktivitas' => $request->aktivitas,
            'keterangan' => $request->keterangan,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.pelaporanTable')->with('success', 'Pelaporan berhasil diupdate');
    }

    public function destroy(string $id)
    {
        $pelaporan = Pelaporan::findOrFail($id);
        $pelaporan->delete();

        return redirect()->route('admin.pelaporanTable')->with('success', 'Pelaporan berhasil dihapus');
    }

    public function updateStatus(Request $request, $id)
{
    $laporan = Pelaporan::findOrFail($id);

    // Toggle status antara proses dan selesai
    $laporan->status = $laporan->status === 'proses' ? 'selesai' : 'proses';
    $laporan->save();

    return redirect()->back()->with('success', 'Status pelaporan berhasil diperbarui.');
}

}
