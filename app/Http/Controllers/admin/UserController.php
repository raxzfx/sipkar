<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.userTable',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jabatans = ['admin', 'karyawan', 'tim penilai', 'kepsek'];
        return view('admin.userAdd',compact('jabatans'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string',
            'nip' => 'required|integer',
            'email' => 'required|email',
            'no_telp' =>  'required|string|regex:/^[0-9]{10,13}$/',
            'jabatan' => 'required',
            'password' => 'nullable|string|min:6'
        ]);
    
        // Siapkan data
        $data = [
            'nama_lengkap' => $request->nama_lengkap,
            'nip' => $request->nip,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'jabatan' => $request->jabatan,
            'password' => Hash::make('password123') // default
        ];

        //konflik jika ada nama yang sama
       $konflik = User::where('nama_lengkap', $request->nama_lengkap)->exists();
       if ($konflik) {
        return redirect()->back()->withErrors(['error', 'Nama tersebut sudah terdaftar, daftarkan yang lainnya']);
       }

       //konflik jika ada no telp yang sama
       $konflik = User::where('no_telp', $request->no_telp)->exists();
       if ($konflik) {
        return redirect()->back()->withErrors(['error', 'Nomor telepon tersebut sudah terdaftar, daftarkan yang lainnya']);
       }
    
        // Jika form password diisi, override password default
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->input('password'));
        }
    
        // Simpan data user
        User::create($data);
    
        return redirect()->route('admin.userTable')->with('success', 'Data berhasil ditambahkan.');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = User::findOrFail($id);
        $jabatans = ['admin', 'karyawan', 'tim penilai', 'kepsek'];
        return view('admin.userEdit', compact('users', 'jabatans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_lengkap' => 'required|string',
            'nip' => 'required|integer',
            'email' => 'required|email',
            'no_telp' =>  'required|string|regex:/^[0-9]{10,13}$/',
            'jabatan' => 'required',
        ]);

        $users = User::findOrFail($id);
        $users->update([
            'nama_lengkap' => $request->nama_lengkap,
            'nip' => $request->nip,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'jabatan' => $request->jabatan,
        ]);
        return redirect()->route('admin.userTable')->with('success', 'Data berhasil diubah.');  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $users = User::findOrFail($id);
        $users->delete();
        return redirect()->route('admin.userTable')->with('success', 'Data berhasil dihapus.');
    }
}
