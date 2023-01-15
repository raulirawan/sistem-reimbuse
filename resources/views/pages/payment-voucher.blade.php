<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    td {
        font-size: 10px;
    }

    body {
        font-family: Calibri, sans-serif
    }
</style>
@php
    $date = Carbon\Carbon::parse($reimbuse->created_at)->locale('id');

    $date->settings(['formatFunction' => 'translatedFormat']);
@endphp

<body>
    <p style="text-align:center">Payment Voucher</p>

    <p style="text-align:center">&nbsp;</p>

    <table border="0" cellspacing="0" style="border-collapse:collapse; height:57px; width:97.7249%">
        <tbody>
            <tr>
                <td style="height:18px; width:95px">NO</td>
                <td style="height:18px; width:6px">:</td>
                <td style="height:18px; width:338px">{{ $reimbuse->no ?? '' }}</td>
                <td style="height:18px; width:94px">BG/CHECKQUE</td>
                <td style="height:18px; width:17px">NO</td>
                <td style="height:18px; width:1px">:</td>
                <td style="height:18px; width:578px">{{ $reimbuse->cheque ?? '' }}</td>
            </tr>
            <tr>
                <td style="height:21px; width:95px">DATE</td>
                <td style="height:21px; width:6px">:</td>
                <td style="height:21px; width:338px">{{ $date->format('j F Y') }}</td>
                <td style="height:21px; width:94px">ACCOUNT</td>
                <td style="height:21px; width:17px">NO</td>
                <td style="height:21px; width:1px">:</td>
                <td style="height:21px; width:578px">{{ $reimbuse->account_no ?? '-' }}</td>
            </tr>
            <tr>
                <td style="height:18px; width:95px">BANK/CASH</td>
                <td style="height:18px; width:6px">:</td>
                <td style="height:18px; width:338px">Rp{{ number_format($reimbuse->total_reimbuse) }}</td>
                <td style="height:18px; width:94px"></td>
                <td style="height:18px; width:17px"></td>
                <td style="height:18px; width:1px"></td>
                <td style="height:18px; width:578px"></td>
            </tr>
        </tbody>
    </table>

    <p>&nbsp;</p>

    <table border="0" cellspacing="0" style="border-collapse:collapse; height:50px; width:688px">
        <tbody>
            <tr>
                <td style="height:18px; width:118.031px">PAYMENT TO</td>
                <td style="height:18px; width:8.9375px">:</td>
                @if ($reimbuse->tipe == 'UANG PRIBADI')
                    <td style="height:18px; width:551.031px">{{ $reimbuse->karyawan->name ?? '-' }}</td>
                @else
                    <td style="height:18px; width:551.031px">Office</td>
                @endif
            </tr>
            <tr>
                <td style="height:18px; width:118.031px">SAYS</td>
                <td style="height:18px; width:8.9375px">:</td>
                <td style="height:18px; width:551.031px">{{ $reimbuse->says }}</td>
            </tr>
        </tbody>
    </table>

    <p>&nbsp;</p>

    <table border="1" style="border:1px solid black; width:100%">
        <tbody>
            <tr>
                <td rowspan="2" style="height:21px; text-align:center; width:16%">Acc. Code&nbsp;</td>
                <td rowspan="2" style="height:21px; text-align:center; width:32.7302%">Descrtiption&nbsp;</td>
                <td colspan="2" style="height:21px; text-align:center; width:34.2698%">Amount&nbsp;&nbsp;</td>
                <td style="height:21px; text-align:center; width:8.72159%">&nbsp;Dr</td>
                <td style="height:21px; text-align:center; width:8.72159%">&nbsp;Cr</td>
            </tr>
            <tr>
                <td style="height:21px; text-align:center; width:18.2698%">&nbsp;USD</td>
                <td style="height:21px; text-align:center; width:18.2698%">&nbsp;Rp</td>
                <td style="height:21px; text-align:center; width:8.72159%">&nbsp;</td>
                <td style="height:21px; text-align:center; width:8.72159%">&nbsp;</td>
            </tr>
            @foreach ($reimbuse->reimbuseDetail as $item)
                <tr>
                    <td style="width:16%">&nbsp;&nbsp;{{ $item->nomor_akun }}</td>
                    <td style="width:32.7302%">&nbsp;&nbsp;{{ $item->nama }}</td>
                    <td style="width:18.2698%">&nbsp;&nbsp;</td>
                    <td style="width:16%">&nbsp;&nbsp;Rp{{ number_format($item->harga) }}</td>
                    <td style="text-align:center; width:8.72159%; font-family: DejaVu Sans, sans-serif;">&#10003;</td>
                    <td style="text-align:center; width:8.72159%">&nbsp;</td>
                </tr>
            @endforeach
            <tr>
                <td style="width:16%">&nbsp;&nbsp;1-11000</td>
                <td style="width:32.7302%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kas Kecil</td>
                <td style="width:18.2698%">&nbsp;</td>
                <td style="width:16%">&nbsp;&nbsp;Rp{{ number_format($reimbuse->total_reimbuse) }}</td>
                <td style="text-align:center; width:8.72159%"></td>
                <td style="text-align:center; width:8.72159%; font-family: DejaVu Sans, sans-serif;">&#10003;</td>
            </tr>
        </tbody>
    </table>

    <p>&nbsp;</p>

    <table border="1" cellspacing="0" style="border-collapse:collapse; height:150px; width:100%">
        <tbody>
            <tr>
                <td style="height:18px; text-align:center; width:25%">Prepared By</td>
                <td style="height:18px; text-align:center; width:25%">Checked By</td>
                <td style="height:18px; text-align:center; width:25%">Approved By</td>
                <td style="height:18px; text-align:center; width:25%">Received By</td>
            </tr>
            <tr>
                <td style="height:96px; text-align:center; width:25%"><span
                        style="font-size:14px">{{ $reimbuse->status_keuangan == 1 ? 'Approve' : '' }}</span></td>
                <td style="height: 96px; width: 25%; text-align: center;"><span
                        style="font-size:14px">{{ $reimbuse->status_sekretaris == 1 ? 'Approve' : '' }}</span>
                </td>
                <td style="height: 96px; width: 25%; text-align: center;"><span
                        style="font-size:14px">{{ $reimbuse->status_partner == 1 ? 'Approve' : '' }}</span>
                </td>
                <td style="height: 96px; width: 25%; text-align: center;"><span
                        style="font-size:14px">{{ ($reimbuse->status == 'SELESAI') == 1 ? 'Approve' : '' }}</span>
                </td>
            </tr>
            <tr>
                <td style="height:18px; width:25%">Name : {{ $reimbuse->keuangan->name ?? '-' }}</td>
                <td style="height:18px; width:25%">Name : {{ $reimbuse->sekretaris->name ?? '-' }}</td>
                <td style="height:18px; width:25%">Name : {{ $reimbuse->partner->name ?? '-' }}</td>
                <td style="height:18px; width:25%">Name : {{ $reimbuse->karyawan->name ?? '-' }}&nbsp;</td>
            </tr>
            @php
                $approveDateKeuangan = Carbon\Carbon::parse($reimbuspe->approve_date_keuangan ?? date('Y-m-d H:i:s'))->locale('id');
                $approveDateKeuangan->settings(['formatFunction' => 'translatedFormat']);

                $approveDateSekretaris = Carbon\Carbon::parse($reimbuse->approve_date_sekretaris ?? date('Y-m-d H:i:s'))->locale('id');
                $approveDateSekretaris->settings(['formatFunction' => 'translatedFormat']);

                $approveDatePartner = Carbon\Carbon::parse($reimbuse->approve_date_partner ?? date('Y-m-d H:i:s'))->locale('id');
                $approveDatePartner->settings(['formatFunction' => 'translatedFormat']);

                $approveDateKaryawan = Carbon\Carbon::parse($reimbuse->approve_date_karyawan ?? date('Y-m-d H:i:s'))->locale('id');
                $approveDateKaryawan->settings(['formatFunction' => 'translatedFormat']);
            @endphp
            <tr>
                <td style="height:18px; width:25%">Date :&nbsp;{{ $approveDateKeuangan->format('j F Y') }}</td>
                <td style="height:18px; width:25%">Date :&nbsp;{{ $approveDateSekretaris->format('j F Y') }}</td>
                <td style="height:18px; width:25%">Date :&nbsp;{{ $approveDatePartner->format('j F Y') }}</td>
                <td style="height:18px; width:25%">Date :&nbsp;{{ $approveDateKaryawan->format('j F Y') }}</td>
            </tr>
        </tbody>
    </table>

</body>

</html>
