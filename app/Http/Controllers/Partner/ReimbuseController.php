<?php

namespace App\Http\Controllers\Partner;

use App\Reimbuse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ReimbuseController extends Controller
{
    public function index()
    {
        $reimbuse = Reimbuse::where(['status_keuangan' => 1, 'status_sekretaris' => 1])->where('status', 'MENUNGGU PARTNER')->orderBy('created_at', 'DESC')->get();
        return view('partner.reimbuse.index', compact('reimbuse'));
    }

    public function show($id)
    {
        $reimbuse = Reimbuse::findOrFail($id);

        return view('karyawan.reimbuse.show', compact('reimbuse'));
    }

    public function approve(Request $request, $reimbuseId)
    {
        $reimbuse = Reimbuse::findOrFail($reimbuseId);

        $reimbuse->partner_id = Auth::user()->id;
        $reimbuse->catatan_partner = $request->catatan_partner;
        $reimbuse->status_partner = 1;
        $reimbuse->status = 'SELESAI';
        $reimbuse->approve_date_partner = now();
        if ($reimbuse->tipe == 'UANG PRIBADI') {
            $reimbuse->status = 'MENUNGGU SEKRETARIS TRANSFER';
        }
        $reimbuse->save();

        if ($reimbuse != null) {
            Alert::success('Success', 'Data Berhasil di Approve');
            return redirect()->route('partner.reimbuse.index');
        } else {
            Alert::error('Error', 'Data Gagal di Approve');
            return redirect()->route('partner.reimbuse.index');
        }
    }
    public function reject(Request $request, $reimbuseId)
    {
        $reimbuse = Reimbuse::findOrFail($reimbuseId);

        if ($request->tolak == 'KARYAWAN') {
            $reimbuse->catatan_partner = $request->catatan_partner;
            $reimbuse->status_partner = 2;
            $reimbuse->status = 'DITOLAK';
            $reimbuse->tolak_pegawai = 1;
            $reimbuse->save();
        }

        if ($request->tolak == 'KEUANGAN') {
            $reimbuse->catatan_partner = $request->catatan_partner;
            $reimbuse->status = 'MENUNGGU KEUANGAN';
            $reimbuse->tolak_keuangan = 1;
            $reimbuse->save();
        }

        if ($reimbuse != null) {
            Alert::success('Success', 'Data Berhasil Di Update');
            return redirect()->route('partner.reimbuse.index');
        } else {
            Alert::error('Error', 'Data Gagal Di Update');
            return redirect()->route('partner.reimbuse.index');
        }
    }
}
