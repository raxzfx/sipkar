<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // Tampilan login
    public function showLoginForm()
    {
        return view ('login');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Menggunakan auth() helper atau Auth facade
            $user = Auth::user(); // atau auth()->user()
            
            return match($user->jabatan) {
                'admin'  => redirect()->route('admin.index'),
                'karyawan'  => redirect()->route('karyawan.index'),
                'tim penilai' => redirect()->route('tim.index'),
                'kepsek'  => redirect()->route('kepsek.index'),
                default     => redirect('/'),
            };
        }

        return back()->withErrors([
            'email' => 'Nomor telepon atau password salah.',
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
