<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'email' => 'unique:users,email',
                'password' => 'min:6',
                'jabatan_id' => 'exists:jabatan,id',
            ],
            [
                'email.unique' => 'Email Sudah Terdaftar',
                'password.min' => 'Password Minimal 6 Karakter',
            ]
        );

        $data = new User();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->roles = $request->roles;
        $data->jabatan_id = $request->jabatan_id;

        $data->save();

        if ($data != null) {
            Alert::success('Success', 'Data Berhasil di Tambah');
            return redirect()->route('admin.user.index');
        } else {
            Alert::error('Error', 'Data Gagal di Tambah');
            return redirect()->route('admin.user.index');
        }
    }
    public function update(Request $request, $id)
    {
        $data = User::findOrFail($id);
        $data->name = $request->name;
        $data->jabatan_id = $request->jabatan_id;
        $data->roles = $request->roles;
        if (!empty($request->password)) {
            $data->password = bcrypt($request->password);
        }
        $data->save();
        if ($data != null) {
            Alert::success('Success', 'Data Berhasil di Update');
            return redirect()->route('admin.user.index');
        } else {
            Alert::error('Error', 'Data Gagal di Update');
            return redirect()->route('admin.user.index');
        }
    }

    public function delete($id)
    {
        $data = User::findOrFail($id);
        if ($data != null) {
            $data->delete();
            Alert::success('Success', 'Data Berhasil di Hapus');
            return redirect()->route('admin.user.index');
        } else {
            Alert::error('Error', 'Data Gagal di Hapus');
            return redirect()->route('admin.user.index');
        }
    }
}
