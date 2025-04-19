<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelaporan;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Histori;
use Illuminate\Support\Facades\Auth;

class PelaporanController extends Controller
{
    public function index()
    {
        $pelaporans = Pelaporan::with('user')->latest()->paginate(10);
        $historiPelaporans = Histori::with([ 'pelaporan'])->latest()->paginate(10);
        $kategoris = Kategori::all();
        return view('admin.pelaporanTable', compact('pelaporans','kategoris', 'historiPelaporans'));
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
            'file' => 'nullable|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:5120', // max 5MB
            'komentar' => 'nullable|string',
        ]);

        
    $fileName = null;

    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/pelaporan'), $fileName);
    }

            // Cek apakah user sudah melaporkan pada tanggal yang sama
            $konflik = Pelaporan::where('user_id', $request->user_id)
            ->whereDate('tanggal_pelaporan', $request->tanggal_pelaporan)
            ->where('status', '!=', 'ditolak') // hanya cegah kalau statusnya bukan "ditolak"
            ->exists();
        

if ($konflik) {
return redirect()->back()->withErrors(['tanggal_pelaporan' => 'Anda sudah melaporkan kegiatan pada tanggal ini.'])->withInput();
}

// Hitung jumlah pelaporan yang sudah ada
$jumlahPelaporan = Pelaporan::count() + 1;

// Format kode unik, contoh: SPKR001, SPKR002, dst
$kodeUnik = 'SPKR' . str_pad($jumlahPelaporan, 3, '0', STR_PAD_LEFT);


        Pelaporan::create([
            'kode_unik' => $kodeUnik,
            'user_id' => $request->user_id,
            'tanggal_pelaporan' => $request->tanggal_pelaporan,
            'aktivitas' => $request->aktivitas,
            'keterangan' => $request->keterangan,
            'user_id' => $request->user_id,
            'status' => 'pending',
            'file' => $fileName,
            'komentar' => $request->komentar
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
            'file' => 'nullable|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:5120', // max 5MB
        ]);
        
        $pelaporan = Pelaporan::findOrFail($id);
        
        // Menangani file baru jika ada
        $fileName = $pelaporan->file; // Ambil nama file lama
        
        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($fileName) {
                $oldFilePath = public_path('uploads/pelaporan/' . $fileName);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath); // Hapus file lama
                }
            }
        
            // Proses unggahan file baru
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/pelaporan'), $fileName); // Simpan file baru
        
            // Ubah status menjadi "pending" setelah revisi dan update lampiran
            $pelaporan->status = 'pending';
        }
        
        // Update data pelaporan dengan file baru atau lama
        $pelaporan->update([
            'tanggal_pelaporan' => $request->tanggal_pelaporan,
            'aktivitas' => $request->aktivitas,
            'keterangan' => $request->keterangan,
            'file' => $fileName, // Gunakan file baru atau file lama
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
    $request->validate([
        'nilai' => 'required|array',
        'nilai.*' => 'required|numeric|min:0|max:100',
        'komentar' => 'nullable|string',
    ]);
    
    $laporan = Pelaporan::findOrFail($id);
    $oldAktivitas = $laporan->aktivitas;
    
    $nilaiArrayOriginal = $request->nilai;
    
    // Ubah menjadi array numerik 0,1,2 dst
    $nilaiArray = array_values($nilaiArrayOriginal);
    
    // Hitung rata-rata
    $jumlahKategori = count($nilaiArray);
    $totalNilai = array_sum($nilaiArray);
    $rataRata = $jumlahKategori > 0 ? round($totalNilai / $jumlahKategori, 2) : null;
    
    // Tentukan status otomatis
    if ($rataRata >= 75 && $rataRata <= 100) {
        $status = 'selesai';
    } elseif ($rataRata >= 51 && $rataRata < 75) {
        $status = 'revisi';
    } else {
        $status = 'ditolak';
    }
    
    // Simpan histori
    Histori::create([
        'user_id'      => $laporan->user_id,
        'pelaporan_id' => $laporan->id_pelaporan,
        'aktivitas'    => $oldAktivitas,
      
        'status'       => $status,
        'nilai_akhir'  => $rataRata,
        'komentar'     => $request->komentar,
    ]);
    
    // Ubah status menjadi pending jika revisi atau pembaruan status
    if ($status === 'revisi') {
        $laporan->status = 'pending';
    }
    
    // Simpan status akhir dan nilai
    $laporan->update([
        'status' => $status,
        'komentar' => $request->komentar,
        'nilai_akhir' => $rataRata,
        'nilai_1' => isset($nilaiArray[0]) ? (int) $nilaiArray[0] : null,
        'nilai_2' => isset($nilaiArray[1]) ? (int) $nilaiArray[1] : null,
        'nilai_3' => isset($nilaiArray[2]) ? (int) $nilaiArray[2] : null,
    ]);
    
    return redirect()->back()->with('success', 'Nilai berhasil disimpan.');
}


}
