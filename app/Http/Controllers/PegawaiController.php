<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PegawaiController extends Controller
{
    public function index()
    {
        return view('pegawai.index', [
            'title' => 'Pegawai',
            'data' => Pegawai::all()
        ]);
    }

    public function show($no_pegawai)
    {
        return view('pegawai', [
            'title' => 'Detail Pegawai',
            'data' => Pegawai::find($no_pegawai)
        ]);
    }

    public function store(Request $request)
    {
        $validator = $this->validatorForm($request);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $pegawai = Pegawai::create([
            'no_pegawai' => $request->no_pegawai,
            'nama_Pegawai' => $request->nama_Pegawai,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tgl_lahir' => $request->tgl_lahir,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
        ]);

        if ($pegawai) {
            return response()->json([
                'success' => true,
                'message' => 'Pegawai created',
                'data' => $pegawai
            ], 201);
        }

        return response()->json([
            'success' => false,
            'message' => 'Pegawai failed to save',
        ], 409);
    }

    public function update(Request $request, Pegawai $pegawai)
    {
        $validator = $this->validatorForm($request);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $pegawai = Pegawai::findOrFail($pegawai->nis);

        if ($pegawai) {
            $pegawai->update([
                'nis' => $request->nis,
                'nama_Pegawai' => $request->nama_Pegawai,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tgl_lahir' => $request->tgl_lahir,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Student updated',
                'data' => $pegawai
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Student not found'
        ], 404);
    }

    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);

        if ($pegawai) {
            $pegawai->delete();

            return response()->json([
                'success' => true,
                'message' => 'Student deleted'
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Student not found'
        ], 404);
    }

    public function validatorForm($form)
    {
        $validator = Validator::make($form->all(), [
            'nis' => 'required|unique:Pegawai',
            'nama_Pegawai' => 'required',
            'jenis_kelamin' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required'
        ]);

        return $validator;
    }
}
