<?php
namespace App\Http\Controllers\tim;

use App\Http\Controllers\Controller;
use App\Models\Penilaian;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;


class RekapController extends Controller
{
    public function index()
    {
        $penilaians = Penilaian::with('qaryawan')->paginate(10);
        return view('tim.rekapData', compact('penilaians'));
    }

    public function exportPdf()
    {
        $penilaians = Penilaian::with('qaryawan')->get(); // tanpa paginate untuk export semua data
        $pdf = Pdf::loadView('tim.rekapPdf', compact('penilaians'));
        return $pdf->download('rekap-penilaian.pdf');
    }
}
