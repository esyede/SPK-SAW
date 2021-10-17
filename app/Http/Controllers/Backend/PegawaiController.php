<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PegawaiController extends Controller
{
    public function index()
    {
        $title = 'Pegawai';
        $data = User::whereHas('role', function ($q) {
            $q->where('slug', '<>', 'director');
        });

        return view('backend.users.index', compact('title', 'data'));
    }

    public function show($pegawaiId)
    {
        $title = 'Pegawai';
        $data = User::find($pegawaiId);

        return view('pegawai', compact('title', 'data'));
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'no_pegawai' => 'required|unique:Pegawai',
            'nama_Pegawai' => 'required',
            'jenis_kelamin' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required'
        ]);

        if ($validation->fails()) {
            notify()->error($validation->errors()->first());
            return back();
        }

        User::create([
            'no_pegawai' => $request->no_pegawai,
            'nama_Pegawai' => $request->nama_Pegawai,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tgl_lahir' => $request->tgl_lahir,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
        ]);

        notify()->success('User berhasil dibuat');
        return back();
    }

    public function update(Request $request, User $user)
    {
        $validation = Validator::make($request->all(), [
            'no_pegawai' => 'required|unique:Pegawai',
            'nama_Pegawai' => 'required',
            'jenis_kelamin' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required'
        ]);

        if ($validation->fails()) {
            notify()->error($validation->errors()->first());
            return back();
        }

        $pegawai = User::find($user->no_pegawai);

        if (! $pegawai) {
            notify()->error('Pegawai tidak ditemukan');
            return back();
        }

        $pegawai->update([
            'no_pegawai' => $request->no_pegawai,
            'nama_Pegawai' => $request->nama_Pegawai,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tgl_lahir' => $request->tgl_lahir,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp
        ]);

        notify()->success('Data pegawai berhasil disimpan');
        return back();
    }

    public function destroy($id)
    {
        $pegawai = User::find($id);

        if (! $pegawai) {
            notify()->error('Pegawai tidak ditemukan');
            return back();
        }

        if (! $pegawai->delete()) {
            notify()->error('Pegawai gagal dihapus');
            return back();
        }

        notify()->success('Pegawai berhasil dihapus');
        return back();
    }
}
