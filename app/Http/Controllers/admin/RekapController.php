<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Penilaian;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;


class RekapController extends Controller
{
    public function index()
    {
        $penilaians = Penilaian::with('qaryawan')->paginate(10);
        return view('admin.rekapData', compact('penilaians'));
    }

    public function exportPdf()
    {
        $penilaians = Penilaian::with('qaryawan')->get(); // tanpa paginate untuk export semua data
        $pdf = Pdf::loadView('admin.rekapPdf', compact('penilaians'));
        return $pdf->download('rekap-penilaian.pdf');
    }
}
