<?php

namespace App\Http\Controllers;

use Pdf;
use App\Reimbuse;
use iio\libmergepdf\Merger;
use Illuminate\Http\Response;

class PaymentVoucherController extends Controller
{
    public function generatePdf($reimbuseId)
    {
        $m = new Merger();

        $reimbuse = Reimbuse::findOrFail($reimbuseId);
        $pdf = Pdf::loadview('pages.payment-voucher', compact('reimbuse'));
        $pdf->setPaper('a4', 'potrait')->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

        $imagePdf = Pdf::loadview('pages.image', compact('reimbuse'));

        $m->addRaw($pdf->output());
        $m->addRaw($imagePdf->output());

        $filename = $reimbuse->created_at . '-' . $reimbuse->karyawan->name . '-payment_voucher.pdf';

        return new Response($m->merge(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' =>  'attachment; filename="' . $filename . '"',
            'Content-Length' => strlen($m->merge()),
        ]);
    }

    public function lihatBuktiNota($reimbuseId)
    {
        $reimbuse = Reimbuse::findOrFail($reimbuseId);
        $imagePdf = Pdf::loadview('pages.image', compact('reimbuse'));
        return $imagePdf->download('bukti-nota-' . $reimbuse->karyawan->name . '.pdf');
    }
}
