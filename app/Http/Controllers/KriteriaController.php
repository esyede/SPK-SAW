<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriteria = Criteria::oldest()->get();

        return response()->json([
            'success' => true,
            'message' => 'List data kriteria',
            'data' => $kriteria
        ], 200);
    }

    public function show($id)
    {
        $kriteria = Criteria::findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Detail data kriteria',
            'data' => $kriteria
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = $this->validatorForm($request);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $kriteria = Criteria::create([
            'nama_kriteria' => $request->nama_kriteria,
            'kode_kriteria' => strtoupper($request->kode_kriteria),
            'attribute' => $request->attribute,
            'bobot' => $request->bobot,
        ]);

        if ($kriteria) {
            return response()->json([
                'success' => true,
                'message' => 'Kriteria created',
                'data' => $kriteria
            ], 201);
        }

        return response()->json([
            'success' => false,
            'message' => 'Criteria failed to save',
        ], 409);
    }

    public function update(Request $request, Criteria $kriteria)
    {
        $validator = $this->validatorForm($request);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $kriteria = Criteria::findOrFail($kriteria->id);

        if ($kriteria) {
            $kriteria->update([
                'nama_kriteria' => $request->nama_kriteria,
                'kode_kriteria' => $request->kode_kriteria,
                'attribute' => $request->attribute,
                'bobot' => $request->bobot,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Criteria updated',
                'data' => $kriteria
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Criteria not found'
        ], 404);
    }

    public function destroy($id)
    {
        $kriteria = Criteria::findOrFail($id);

        if ($kriteria) {
            $kriteria->delete();

            return response()->json([
                'success' => true,
                'message' => 'Criteria deleted'
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Criteria not found'
        ], 404);
    }

    public function validatorForm($form)
    {
        $validator = Validator::make($form->all(), [
            'nama_kriteria' => 'required',
            // 'attribute' => 'required',
            'bobot' => 'required',
            'kode_kriteria' => 'required'
        ]);

        return $validator;
    }
}
