<?php

namespace App\Http\Controllers\Backend;

use App\Models\Criteria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Criteria\StoreCriteriaRequest;
use Illuminate\Support\Facades\Validator;

class KriteriaController extends Controller
{
    public function index()
    {
        $criterias = Criteria::latest()->get();

        return view('backend.kriteria.index', compact('criterias'));
    }

    public function show($id)
    {
        $criterias = Criteria::findOrFail($id);

        return view('backend.kriteria.show', compact($criterias));
    }

    public function create()
    {
        return view('backend.kriteria.form');
    }

    public function store(StoreCriteriaRequest $request)
    {
        // $validator = $this->validatorForm($request);

        $criterias = Criteria::create([
            'nama_kriteria' => $request->nama_kriteria,
            'kode_kriteria' => strtoupper($request->kode_kriteria),
            'attribute' => $request->attribute,
            'bobot' => $request->bobot,
        ]);

        if ($criterias) {
            notify()->success('Criteria sucessfully added', 'Added');

            return redirect()->route('app.kriteria.index');
        }
    }

    public function update(Request $request, Criteria $criterias)
    {
        $validator = $this->validatorForm($request);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $criterias = Criteria::findOrFail($criterias->kode_kriteria);

        if ($criterias) {
            $criterias->update([
                'nama_kriteria' => $request->nama_kriteria,
                'kode_kriteria' => $request->kode_kriteria,
                'attribute' => $request->attribute,
                'bobot' => $request->bobot,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Criteria updated',
                'data' => $criterias
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Criteria not found'
        ], 404);
    }

    public function destroy($id)
    {
        $criterias = Criteria::findOrFail($id);

        if ($criterias) {
            $criterias->delete();

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
            'attribute' => 'nullable',
            'bobot' => 'required',
            'kode_kriteria' => 'required'
        ]);

        return $validator;
    }
}
