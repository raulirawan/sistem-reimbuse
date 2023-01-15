<?php

namespace App\Http\Controllers\Sekretaris;

use App\Reimbuse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ReimbuseController extends Controller
{
    public function index()
    {
        $reimbuse = Reimbuse::where('status', 'MENUNGGU SEKRETARIS')->where('status_sekretaris', '!=', 1)->orderBy('created_at', 'DESC')->get();
        return view('sekretaris.reimbuse.index', compact('reimbuse'));
    }

    public function indexTransfer()
    {
        $reimbuse = Reimbuse::where(['status_keuangan' => 1, 'status_sekretaris' => 1, 'status_partner' => 1])->whereNull('bukti_transfer')->where('tipe', 'UANG PRIBADI')->orderBy('created_at', 'DESC')->get();
        return view('sekretaris.reimbuse.index-transfer', compact('reimbuse'));
    }

    public function uploadBuktiTransfer(Request $request, $reimbuseId)
    {
        $request->validate(
            [
                'bukti_transfer' => 'mimes:jpeg,png,jpg|max:1028',
            ],
            [
                'bukti_transfer.mimes' => 'Gambar Harus Bertipe PNG, JPG, atau JPEG',
            ]
        );
        $reimbuse = Reimbuse::findOrFail($reimbuseId);

        if ($request->hasFile('bukti_transfer')) {
            $file = $request->file('bukti_transfer');
            $tujuan_upload = 'image/bukt-transfer/';
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $nama_file = str_replace(' ', '', $nama_file);
            $file->move($tujuan_upload, $nama_file);

            $reimbuse->bukti_transfer = $tujuan_upload . $nama_file;
        }
        $reimbuse->approve_date_karyawan = now();
        $reimbuse->status = 'SELESAI';
        $reimbuse->save();
        if ($reimbuse != null) {
            Alert::success('Success', 'Data Berhasil di Simpan');
            return redirect()->route('sekretaris.reimbuse.index');
        } else {
            Alert::error('Error', 'Data Gagal di Simpan');
            return redirect()->route('sekretaris.reimbuse.index');
        }
    }

    public function show($id)
    {
        $reimbuse = Reimbuse::findOrFail($id);

        return view('karyawan.reimbuse.show', compact('reimbuse'));
    }

    public function approve(Request $request, $reimbuseId)
    {
        $reimbuse = Reimbuse::findOrFail($reimbuseId);

        $reimbuse->sekretaris_id = Auth::user()->id;
        $reimbuse->catatan_sekretaris = $request->catatan_sekretaris;
        $reimbuse->status_sekretaris = 1;
        $reimbuse->status = 'MENUNGGU PARTNER';
        $reimbuse->approve_date_sekretaris = now();
        $reimbuse->save();

        if ($reimbuse != null) {
            Alert::success('Success', 'Data Berhasil di Approve');
            return redirect()->route('sekretaris.reimbuse.index');
        } else {
            Alert::error('Error', 'Data Gagal di Approve');
            return redirect()->route('sekretaris.reimbuse.index');
        }
    }
    public function reject(Request $request, $reimbuseId)
    {
        $reimbuse = Reimbuse::findOrFail($reimbuseId);

        if ($request->tolak == 'KARYAWAN') {
            $reimbuse->catatan_sekretaris = $request->catatan_sekretaris;
            $reimbuse->status_sekretaris = 2;
            $reimbuse->status = 'DITOLAK';
            $reimbuse->tolak_pegawai = 1;
            $reimbuse->save();
        }

        if ($request->tolak == 'KEUANGAN') {
            $reimbuse->catatan_sekretaris = $request->catatan_sekretaris;
            $reimbuse->status = 'MENUNGGU KEUANGAN';
            $reimbuse->tolak_keuangan = 1;
            $reimbuse->save();
        }

        if ($reimbuse != null) {
            Alert::success('Success', 'Data Berhasil Di Update');
            return redirect()->route('sekretaris.reimbuse.index');
        } else {
            Alert::error('Error', 'Data Gagal Di Update');
            return redirect()->route('sekretaris.reimbuse.index');
        }
    }
}
