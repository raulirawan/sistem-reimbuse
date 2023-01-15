<?php

namespace App\Http\Controllers;

use App\Reimbuse;
use Illuminate\Http\Request;
use Pdf;

class PaymentVoucherController extends Controller
{
    public function generatePdf($reimbuseId)
    {
        // return view('pages.payment-voucher');
        $reimbuse = Reimbuse::findOrFail($reimbuseId);
        $pdf = Pdf::loadview('pages.payment-voucher', compact('reimbuse'));
        $pdf->setPaper('a4', 'potrait')->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        return $pdf->download($reimbuse->created_at . '-' . $reimbuse->karyawan->name . '-payment_voucher.pdf');
    }
}
