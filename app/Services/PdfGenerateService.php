<?php

namespace App\Services;

use Dompdf\Dompdf;
use Dompdf\Options;
use PDF;

class PdfGenerateService
{

    public function list_order_inventory($order, $data)

    {

        $pdf = new Dompdf();
        $html = view('list_order_approve', compact('order', 'data'));
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'potrait');
        $pdf->render();
        return $pdf;
    }

    public function surat_jalan_pdf($order, $data)

    {

        $pdf = new Dompdf();
        $html = view('surat_jalan_pdf', compact('order', 'data'));
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'potrait');
        $pdf->render();
        return $pdf;
    }

    public function lihat_pesanan_pelanggan($order, $data)

    {

        $pdf = new Dompdf();
        $html = view('lihat_pesanan', compact('order', 'data'));
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'potrait');
        $pdf->render();
        return $pdf;
    }
}
