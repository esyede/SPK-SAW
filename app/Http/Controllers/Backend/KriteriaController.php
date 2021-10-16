<?php

namespace App\Http\Controllers\Backend;

use App\Models\Role;
use App\Models\Criteria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Criteria\StoreCriteriaRequest;

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

    public function store(Request $request)
    {
        Gate::authorize('app.criteria.create');

        $criterias = Criteria::create([
            'criteria_name' => $request->criteria_name,
            'criteria_code' => strtoupper($request->criteria_code),
        ]);

        if ($criterias) {
            notify()->success('Criteria sucessfully added', 'Added');
        } else {
            notify()->failed('Failed to add criteria', 'Failed');
        }

        return redirect()->route('app.criterias.index');
    }

    public function edit(Criteria $criteria)
    {
        return view('backend.kriteria.edit', compact('criteria'));
    }

    public function update(Request $request, Criteria $criteria)
    {
        $validator = $this->validatorForm($request);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $criterias = Criteria::findOrFail($criteria->criteria_code);

        if ($criterias) {
            $criterias->update([
                'criteria_name' => $request->criteria_name,
                'criteria_code' => $request->criteria_code,
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

            notify()->success('Criteria deleted', 'Added');

            return back();
        }

        return response()->json([
            'success' => false,
            'message' => 'Criteria not found'
        ], 404);
    }

    public function validatorForm($form)
    {
        $validator = Validator::make($form->all(), [
            'criteria_name' => 'required',
            'attribute' => 'nullable',
            'bobot' => 'required',
            'criteria_code' => 'required'
        ]);

        return $validator;
    }
}
