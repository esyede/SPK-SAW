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
            notify()->success('Kriteria berhasil ditambahkan');
        } else {
            notify()->error('Gagal menambahkan kriteria');
        }

        return redirect()->route('app.criterias.index');
    }

    public function edit(Criteria $criteria)
    {
        return view('backend.kriteria.edit', compact('criteria'));
    }

    public function update(Request $request, Criteria $criteria)
    {
        $validator = Validator::make($request->all(), [
            'criteria_name' => 'required',
            'attribute' => 'nullable',
            'bobot' => 'required',
            'criteria_code' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $criterias = Criteria::find($criteria->criteria_code);

        if (! $criterias) {
            notify()->error('Kriteria tidak ditemukan');
            return back();
        }

        $criterias->update([
            'criteria_name' => $request->criteria_name,
            'criteria_code' => $request->criteria_code,
        ]);

        notify()->success('Kriteria berhasil ditambahkan');
        return back();
    }

    public function destroy($id)
    {
        $criteria = Criteria::find($id);

        if (! $criteria) {
            notify()->error('Kriteria tidak ditemukan');
            return back();
        }

        if (! $criterias->delete()) {
            notify()->error('Kriteria gagal dihapus');
            return back();
        }

        notify()->success('Kriteria berhasil dihapus');
        return back();
    }
}
