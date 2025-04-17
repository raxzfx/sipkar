<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\User;
use App\Models\Divisi;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawans = Karyawan::with(['user', 'divisi'])->paginate(10);
        return view('admin.karyawanTable', compact('karyawans'));
    }

    public function create()
    {
        $users = User::where('jabatan', 'karyawan')->get();
        $divisis = Divisi::all();
        return view('admin.karyawanAdd', compact('users', 'divisis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:user,id_user',
            'divisi_id' => 'required|exists:divisi,id_divisi',
        ]);

        $konflik = Karyawan::where('user_id', $request->user_id)->exists();

        if($konflik){
            return redirect()->back()->withErrors(['error', 'nama karyawan sudah terdaftar']);
        }

        Karyawan::create([
            'user_id' => $request->user_id,
            'divisi_id' => $request->divisi_id,
        ]);

        return redirect()->route('admin.karyawanTable')->with('success', 'Data karyawan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $users = User::where('jabatan', 'karyawan')->get();
        $divisis = Divisi::all();
        return view('admin.karyawanEdit', compact('karyawan', 'users', 'divisis'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:user,id_user',
            'divisi_id' => 'required|exists:divisi,id_divisi',
        ]);

        $karyawan = Karyawan::findOrFail($id);
        $karyawan->update([
            'user_id' => $request->user_id,
            'divisi_id' => $request->divisi_id,
        ]);

        return redirect()->route('admin.karyawanTable')->with('success', 'Data karyawan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->delete();

        return redirect()->route('admin.karyawanTable')->with('success', 'Data karyawan berhasil dihapus.');
    }
}
