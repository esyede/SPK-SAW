<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::oldest()->get();

        return response()->json([
            'success' => true,
            'message' => 'List data siswa',
            'data' => $siswa
        ], 200);
    }

    public function show($id)
    {
        $siswa = Siswa::findOrFail($id);

        return response()->json([
            'success' => true,
            'message => Detail siswa',
            'data' => $siswa
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = $this->validatorForm($request);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $siswa = Siswa::create([
            'nis' => $request->nis,
            'nama_siswa' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tgl_lahir' => $request->tgl_lahir,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
        ]);

        if ($siswa) {
            return response()->json([
                'success' => true,
                'message' => 'Siswa created',
                'data' => $siswa
            ], 201);
        }

        return response()->json([
            'success' => false,
            'message' => 'Criteria failed to save',
        ], 409);
    }

    public function update(Request $request, Siswa $siswa)
    {
        $validator = $this->validatorForm($request);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $siswa = Siswa::findOrFail($siswa->id);

        if ($siswa) {
            $siswa->update([
                'nis' => $request->nis,
                'nama_siswa' => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tgl_lahir' => $request->tgl_lahir,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Siswa updated',
                'data' => $siswa
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Siswa not found'
        ], 404);
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);

        if ($siswa) {
            $siswa->delete();

            return response()->json([
                'success' => true,
                'message' => 'Siswa deleted'
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Siswa not found'
        ], 404);
    }

    public function validatorForm($form)
    {
        $validator = Validator::make($form->all(), [
            'nis' => 'required',
            'nama_siswa' => 'required',
            'jenis_kelamin' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required'
        ]);

        return $validator;
    }
}
