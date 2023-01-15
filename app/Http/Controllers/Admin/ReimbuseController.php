<?php

namespace App\Http\Controllers\Admin;

use App\Reimbuse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReimbuseController extends Controller
{
    public function index()
    {
        $reimbuse = Reimbuse::orderBy('created_at', 'DESC')->get();
        return view('admin.reimbuse.index', compact('reimbuse'));
    }

    public function show($id)
    {
        $reimbuse = Reimbuse::findOrFail($id);

        return view('karyawan.reimbuse.show', compact('reimbuse'));
    }
}
