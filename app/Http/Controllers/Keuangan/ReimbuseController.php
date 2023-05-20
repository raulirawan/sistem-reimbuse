<?php

namespace App\Http\Controllers\Keuangan;

use App\Reimbuse;
use App\ReimbuseDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ReimbuseController extends Controller
{
    public function index()
    {
        $reimbuse = Reimbuse::where('status', 'MENUNGGU KEUANGAN')->where('status_keuangan', 0)->orderBy('created_at', 'DESC')->get();
        return view('keuangan.reimbuse.index', compact('reimbuse'));
    }

    public function indexAll()
    {
        $reimbuse = Reimbuse::orderBy('created_at', 'DESC')->get();
        return view('keuangan.reimbuse.index-all', compact('reimbuse'));
    }

    public function indexTolak()
    {
        $reimbuse = Reimbuse::where(['status' => 'MENUNGGU KEUANGAN', 'tolak_keuangan' => 1])->orderBy('created_at', 'DESC')->get();
        return view('keuangan.reimbuse.index-tolak', compact('reimbuse'));
    }

    public function paymentVoucher(Request $request, $reimbuseId)
    {
        $reimbuse = Reimbuse::findOrFail($reimbuseId);

        $reimbuse->no = $request->no;
        $reimbuse->cheque = $request->cheque;
        $reimbuse->payment_to = $request->payment_to;
        $reimbuse->account_no = $request->account_no;
        $reimbuse->says = $request->says;
        $reimbuse->catatan_keuangan = $request->catatan_keuangan;
        $reimbuse->status_keuangan = 1;
        $reimbuse->keuangan_id = Auth::user()->id;
        $reimbuse->status = 'MENUNGGU SEKRETARIS';
        $reimbuse->approve_date_keuangan = now();

        //    insert to detail
        $reimbuseDetail = [];
        foreach ($request->nomor_akun as $key => $value) {
            $reimbuseDetail[] = [
                'reimbuse_id' => $reimbuseId,
                'nomor_akun' => $value,
                'nama' => $request->nama[$key],
                'harga' => $request->harga[$key],
                'tipe_uang' => $request->tipe_uang[$key],
                'status' => $request->status[$key],
            ];
        }
        ReimbuseDetail::insert($reimbuseDetail);
        $reimbuse->save();
        if ($reimbuse != null) {
            Alert::success('Success', 'Payment Voucher Berhasil Di Buat');
            return redirect()->route('keuangan.reimbuse.index');
        } else {
            Alert::error('Error', 'Payment Voucher Gagal Di Buat');
            return redirect()->route('keuangan.reimbuse.index');
        }
    }

    public function updatePaymentVoucher(Request $request, $reimbuseId)
    {
        $reimbuse = Reimbuse::findOrFail($reimbuseId);

        $reimbuse->no = $request->no;
        $reimbuse->cheque = $request->cheque;
        $reimbuse->payment_to = $request->payment_to;
        $reimbuse->account_no = $request->account_no;
        $reimbuse->says = $request->says;
        $reimbuse->catatan_keuangan = $request->catatan_keuangan;
        $reimbuse->status_keuangan = 1;
        $reimbuse->status_sekretaris = 0;
        $reimbuse->keuangan_id = Auth::user()->id;
        $reimbuse->tolak_keuangan = 0;
        $reimbuse->status = 'MENUNGGU SEKRETARIS';

        //    insert to detail
        $reimbuseDetail = [];
        foreach ($request->nomor_akun as $key => $value) {
            $reimbuseDetail[] = [
                'reimbuse_id' => $reimbuseId,
                'nomor_akun' => $value,
                'nama' => $request->nama[$key],
                'harga' => $request->harga[$key],
                'tipe_uang' => $request->tipe_uang[$key],
                'status' => $request->status[$key],
            ];
        }
        ReimbuseDetail::insert($reimbuseDetail);
        $reimbuse->save();
        if ($reimbuse != null) {
            Alert::success('Success', 'Payment Voucher Berhasil Di Buat');
            return redirect()->route('keuangan.reimbuse.index');
        } else {
            Alert::error('Error', 'Payment Voucher Gagal Di Buat');
            return redirect()->route('keuangan.reimbuse.index');
        }
    }

    public function reimbuseTolak(Request $request, $reimbuseId)
    {
        $reimbuse = Reimbuse::findOrFail($reimbuseId);

        $reimbuse->catatan_keuangan = $request->catatan_keuangan;
        $reimbuse->status = 'DITOLAK';
        $reimbuse->status_keuangan = 2;
        $reimbuse->save();
        if ($reimbuse != null) {
            Alert::success('Success', 'Data Berhasil Di Update');
            return redirect()->route('keuangan.reimbuse.index');
        } else {
            Alert::error('Error', 'Data Gagal Di Update');
            return redirect()->route('keuangan.reimbuse.index');
        }
    }

    public function show($id)
    {
        $reimbuse = Reimbuse::findOrFail($id);

        return view('karyawan.reimbuse.show', compact('reimbuse'));
    }

    public function indexTransfer()
    {
        $reimbuse = Reimbuse::where(['status_keuangan' => 1, 'status_sekretaris' => 1, 'status_partner' => 1])->whereNull('bukti_transfer')->where('tipe', 'UANG PRIBADI')->orderBy('created_at', 'DESC')->get();
        return view('keuangan.reimbuse.index-transfer', compact('reimbuse'));
    }

    public function approveTransfer(Request $request, $reimbuseId)
    {

        $reimbuse = Reimbuse::findOrFail($reimbuseId);

        $reimbuse->bukti_transfer = $request->bukti_transfer;
        $reimbuse->status = 'MENUNGGU KARYAWAN';
        $reimbuse->save();

        if ($reimbuse != null) {
            Alert::success('Success', 'Data Berhasil di Simpan');
            return redirect()->route('keuangan.reimbuse.index');
        } else {
            Alert::error('Error', 'Data Gagal di Simpan');
            return redirect()->route('keuangan.reimbuse.index');
        }
    }
}
