<?php

namespace App\Http\Controllers;

use Pdf;
use App\Reimbuse;
use iio\libmergepdf\Merger;
use Illuminate\Http\Response;

class PaymentVoucherController extends Controller
{
    public function generatePdf($reimbuseId, $param = 'lihat')
    {
        $m = new Merger();

        $reimbuse = Reimbuse::findOrFail($reimbuseId);
        $pdf = Pdf::loadview('pages.payment-voucher', compact('reimbuse'));
        $pdf->setPaper('a4', 'potrait')->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

        $imagePdf = Pdf::loadview('pages.image', compact('reimbuse'));

        $m->addRaw($pdf->output());

        $isImage = false;
        foreach (json_decode($reimbuse->bukti_nota) as $key => $value) {
            if (str_contains($value, '.pdf')) {
                $tempPdf[] = [
                    'file' => $value,
                ];
            } else {
                $isImage = true;
            }
        }
        if (!empty($tempPdf)) {
            foreach ($tempPdf as $key => $value) {
                $m->addFile($value['file']);
            }
        }

        if ($isImage) {
            $m->addRaw($imagePdf->output());
        }

        $filename = 'payment-voucher/'. $reimbuse->karyawan->name . '-payment_voucher.pdf';

        if ($param == 'download') {
            return new Response($m->merge(), 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' =>  'attachment; filename="' . $filename . '"',
                'Content-Length' => strlen($m->merge()),
            ]);
        }
        file_put_contents($filename, $m->merge());
        return redirect($filename);
    }

    public function lihatBuktiNota($reimbuseId, $param = 'lihat')
    {
        $m = new Merger();
        $reimbuse = Reimbuse::findOrFail($reimbuseId);
        $imagePdf = Pdf::loadview('pages.image', compact('reimbuse'));
        // check has pdf
        $tempPdf = [];
        $isImage = false;
        foreach (json_decode($reimbuse->bukti_nota) as $key => $value) {

            if (str_contains($value, '.pdf')) {
                $tempPdf[] = [
                    'file' => $value,
                ];
            } else {
                $isImage = true;
            }
        }
        if (!empty($tempPdf)) {
            foreach ($tempPdf as $key => $value) {
                $m->addFile($value['file']);
            }
        }
        if ($isImage) {
            $m->addRaw($imagePdf->output());
        }
        $filename = 'bukti-nota/'.'bukti-nota-' . $reimbuse->karyawan->name . '.pdf';
        if ($param == 'download') {
            return new Response($m->merge(), 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' =>  'attachment; filename="' . $filename . '"',
                'Content-Length' => strlen($m->merge()),
            ]);
        }
        file_put_contents($filename, $m->merge());
        return redirect($filename);
    }
}
