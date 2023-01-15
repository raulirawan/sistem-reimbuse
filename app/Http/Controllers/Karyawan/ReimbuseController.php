<?php

namespace App\Http\Controllers\Karyawan;

use App\Reimbuse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ReimbuseController extends Controller
{
    public function index()
    {
        $reimbuse = Reimbuse::where('karyawan_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
        return view('karyawan.reimbuse.index', compact('reimbuse'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'bukti_nota.*' => 'mimes:jpeg,png,jpg|max:2048',
            ],
            [
                'bukti_nota.mimes.%' => 'Gambar Harus Bertipe PNG, JPG, atau JPEG',
            ]
        );

        $data = new Reimbuse();
        $data->tanggal_pengajuan = now();
        $data->karyawan_id = Auth::user()->id;
        $data->total_reimbuse = $request->total_reimbuse;
        $data->tipe = $request->tipe;
        $data->status_keuangan = 0;
        $data->status = 'MENUNGGU KEUANGAN';

        if ($request->hasFile('bukti_nota')) {
            $dataFile = [];
            foreach ($request->file('bukti_nota') as $key => $val) {
                $tujuan_upload = 'bukti-nota/' . Auth::user()->id . '/';
                $nama_file = time() . "_" . $val->getClientOriginalName();
                $nama_file = str_replace(' ', '', $nama_file);
                $val->move($tujuan_upload, $nama_file);

                $dataFile[] = $tujuan_upload . $nama_file;
            }
            $file = json_encode($dataFile);
            $data->bukti_nota = $file;
        }

        $data->save();

        if ($data != null) {
            Alert::success('Success', 'Data Berhasil di Tambah');
            return redirect()->route('karyawan.reimbuse.index');
        } else {
            Alert::error('Error', 'Data Gagal di Tambah');
            return redirect()->route('karyawan.reimbuse.index');
        }
    }

    public function show($id)
    {
        $reimbuse = Reimbuse::findOrFail($id);

        return view('karyawan.reimbuse.show', compact('reimbuse'));
    }
}
