<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    //
    public function generate()
    {
        $data = [
            'title' => 'Struk Belanja',
            'date' => date('m/d/Y'),
            'content' => 'Ini isi laporan yang ingin dicetak.'
        ];

        $pdf = Pdf::loadView('pdf.struk', $data);

        return $pdf->download('struk-belanja.pdf');
    }
}
