<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Models\SubCriteria;
use App\Models\Role;
use App\Models\Criteria;

class SubCriteriaController extends Controller
{
    public function index()
    {
        Gate::authorize('sub-criteria.index');

        $subcriteria = SubCriteria::latest()->get();
        return view('backend.subcriteria.index', compact('subcriteria'));
    }

    public function create()
    {
        Gate::authorize('sub-criteria.create');

        $criteria = Criteria::all();

        return view('backend.subcriteria.create', compact('criteria'));
    }

    public function store(Request $request)
    {
        Gate::authorize('sub-criteria.create');

        $validator = Validator::make($request->all(),[
            'criteria_id'       => 'required|integer|exists:criterias,id',
            'subcriteria_code'  => 'required|string|max:255',
            'name'              => 'required|string|max:255',
            'standard_value'    => 'required|integer'
        ]);

        if ($validator->fails()) {
            notify()->error($validator->errors()->first());
            return back();
        }

        $subcriteria = SubCriteria::create([
            'criteria_id'       => $request->criteria_id,
            'subcriteria_code'  => $request->subcriteria_code,
            'name'              => $request->name,
            'standard_value'    => $request->standard_value,
        ]);

        if ($subcriteria) {
            notify()->success('Sub Kriteria berhasil ditambahkan');
        } else {
            notify()->error('Gagal menambahkan Sub Kriteria');
        }

        return redirect()->route('sub-criteria.index');
    }

    public function edit($id)
    {
        Gate::authorize('sub-criteria.edit');

        $criteria    = Criteria::all();
        $subcriteria = SubCriteria::find($id);

        if (!$subcriteria) {
            notify()->error('Sub Kriteria tidak ditemukan');
            return back();
        }

        return view('backend.subcriteria.edit', compact('criteria', 'subcriteria'));
    }

    public function update(Request $request, $id)
    {
        Gate::authorize('sub-criteria.edit');

        $validate = Validator::make($request->all(), [
            'criteria_id'       => 'required|integer|exists:criterias,id',
            'subcriteria_code'  => 'required|string|max:255',
            'name'              => 'required|string|max:255',
            'standard_value'    => 'required|integer'
        ]);

        if ($validate->fails()) {
            notify()->error($validate->errors()->first());
        }

        $subcriteria = SubCriteria::find($id);

        if (!$subcriteria) {
            notify()->error('Sub Kriteria tidak ditemukan');
        }

        $subcriteria->update([
            'criteria_id'       => $request->criteria_id,
            'subcriteria_code'  => $request->subcriteria_code,
            'name'              => $request->name,
            'standard_value'    => $request->standard_value,
        ]);

        if ($subcriteria) {
            notify()->success('Berhasil mengubah data Sub Kriteria');
        } else {
            notify()->success('Gagal mengubah data Sub Kriteria');
        }

        return redirect()->route('sub-criteria.index');
    }

    public function destroy($id)
    {
        Gate::authorize('sub-criteria.destroy');

        $subcriteria = SubCriteria::find($id);

        if (!$subcriteria) {
            notify()->error('Sub Kriteria gagal dihapus');
        }

        $subcriteria->delete();

        notify()->success('Sub Kriteria berhasil dihapus');
        return back();
    }
}
