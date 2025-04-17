<?php

namespace App\Http\Controllers\tim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penilaian;
use App\Models\User;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;

class PenilaianController extends Controller
{
    public function index()
    {
        $penilaians = Penilaian::with(['qaryawan', 'kategori', 'tim_penilai'])->latest()->paginate(10);
        return view('tim.penilaianTable', compact('penilaians'));
    }

    public function create()
    {
        $karyawans = User::where('jabatan', 'karyawan')->get();
        $kategori = Kategori::all();
        return view('tim.penilaianAdd', compact('karyawans', 'kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'karyawan' => 'required|exists:user,id_user',
            'kategori_id' => 'required|exists:kategori_penilaian,id_kategori_penilaian',
            'skor' => 'required|numeric|min:0|max:100',
            'tanggal_penilaian' => 'required|date'
        ]);

        $kategori = Kategori::find($request->kategori_id);
        $nilaiKategori = $kategori->nilai;

        // Hitung rata-rata
        $skor = ($request->skor + $nilaiKategori) / 2;


        Penilaian::create([
            'karyawan' => $request->karyawan,
            'kategori_id' => $request->kategori_id,
            'user_id' => Auth::user()->id_user,
            'skor' => $skor,
            'tanggal_penilaian' => $request->tanggal_penilaian
        ]);

        return redirect()->route('tim.penilaianTable')->with('success', 'Data penilaian berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $penilaian = Penilaian::findOrFail($id);
        $penilaian->delete();

        return redirect()->route('tim.penilaianTable')->with('success', 'Data penilaian berhasil dihapus.');
    }
}
