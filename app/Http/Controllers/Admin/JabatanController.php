<?php

namespace App\Http\Controllers\Admin;

use App\Jabatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class JabatanController extends Controller
{
    public function index()
    {
        $jabatans = Jabatan::all();
        return view('admin.jabatan.index', compact('jabatans'));
    }

    public function store(Request $request)
    {
        $data = new Jabatan();
        $data->nama_jabatan = $request->nama_jabatan;

        $data->save();

        if ($data != null) {
            Alert::success('Success', 'Data Berhasil di Tambah');
            return redirect()->route('admin.jabatan.index');
        } else {
            Alert::error('Error', 'Data Gagal di Tambah');
            return redirect()->route('admin.jabatan.index');
        }
    }
    public function update(Request $request, $id)
    {
        $data = Jabatan::findOrFail($id);
        $data->nama_jabatan = $request->nama_jabatan;

        $data->save();
        if ($data != null) {
            Alert::success('Success', 'Data Berhasil di Update');
            return redirect()->route('admin.jabatan.index');
        } else {
            Alert::error('Error', 'Data Gagal di Update');
            return redirect()->route('admin.jabatan.index');
        }
    }

    public function delete($id)
    {
        $data = Jabatan::findOrFail($id);
        if ($data != null) {
            $data->delete();
            Alert::success('Success', 'Data Berhasil di Hapus');
            return redirect()->route('admin.jabatan.index');
        } else {
            Alert::error('Error', 'Data Gagal di Hapus');
            return redirect()->route('admin.jabatan.index');
        }
    }
}
