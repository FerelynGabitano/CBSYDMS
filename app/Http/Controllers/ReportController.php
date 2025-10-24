<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function downloadPDF()
    {
        $data = [
            'title' => 'Laravel PDF Download Example',
            'content' => 'This file was generated and downloaded using DOMPDF.'
        ];

        $pdf = Pdf::loadView('pdf.sample', $data);
        return $pdf->download('report.pdf');
    }
}

