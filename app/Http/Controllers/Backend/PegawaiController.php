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
        return view('pegawai.index', [
            'title' => 'Pegawai',
            'data' => User::all()
        ]);
    }

    public function show($no_pegawai)
    {
        return view('pegawai', [
            'title' => 'Detail Pegawai',
            'data' => User::find($no_pegawai)
        ]);
    }

    public function store(Request $request)
    {
        $validator = $this->validationForm($request);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $pegawai = User::create([
            'no_pegawai' => $request->no_pegawai,
            'nama_Pegawai' => $request->nama_Pegawai,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tgl_lahir' => $request->tgl_lahir,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
        ]);

        if ($pegawai) {
            return back()->with('success', 'Data user berhasil di buat!');
        }
        return back()->with('failed', 'Data user gagal di buat!');
    }

    public function update(Request $request, User $user)
    {
        $validator = $this->validationForm($request);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $pegawai = User::findOrFail($user->no_pegawai);

        if ($pegawai) {
            $pegawai->update([
                'no_pegawai' => $request->no_pegawai,
                'nama_Pegawai' => $request->nama_Pegawai,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tgl_lahir' => $request->tgl_lahir,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp
            ]);

            return back()->with('success', 'Data sukses di perbarui!');
        }

        return back()->with('failed', 'Data gagal di perbarui!');
    }

    public function destroy($id)
    {
        $pegawai = User::findOrFail($id);

        if ($pegawai) {
            $pegawai->delete();

            return back()->with('success', 'Data sukses di hapus!');
        }

        return back()->with('failed', 'Data gagal di hapus!');
    }

    public function validationForm($form)
    {
        $validator = Validator::make($form->all(), [
            'no_pegawai' => 'required|unique:Pegawai',
            'nama_Pegawai' => 'required',
            'jenis_kelamin' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required'
        ]);

        return $validator;
    }
}
