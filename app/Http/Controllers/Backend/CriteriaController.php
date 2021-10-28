<?php

namespace App\Http\Controllers\Backend;

use App\Models\Role;
use App\Models\Criteria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Criteria\StoreCriteriaRequest;

class CriteriaController extends Controller
{
    public function index()
    {
        Gate::authorize('criteria.index');

        $criterias = Criteria::latest()->get();
        return view('backend.criteria.index', compact('criterias'));
    }

    public function create()
    {
        Gate::authorize('criteria.create');

        return view('backend.criteria.create');
    }

    public function store(Request $request)
    {
        Gate::authorize('criteria.create');

        $validation = Validator::make($request->all(), [
            'criteria_name' => 'required|string|min:3|max:191',
            'criteria_code' => 'required|string|min:2|max:20',
        ]);

        if ($validation->fails()) {
            notify()->error($validation->errors()->first());
            return back();
        }

        $criterias = Criteria::create([
            'criteria_name' => $request->criteria_name,
            'criteria_code' => strtoupper($request->criteria_code),
        ]);

        if ($criterias) {
            notify()->success('Kriteria berhasil ditambahkan');
        } else {
            notify()->error('Gagal menambahkan kriteria');
        }

        return redirect()->route('criteria.index');
    }

    public function edit(Request $request, $id)
    {
        Gate::authorize('criteria.edit');

        $criteria = Criteria::find($id);

        if (! $criteria) {
            notify()->error('Kriteria tidak ditemukan');
            return back();
        }

        return view('backend.criteria.edit', compact('criteria'));
    }

    public function update(Request $request, $id)
    {
        Gate::authorize('criteria.edit');

        $validation = Validator::make($request->all(), [
            'criteria_name' => 'required|string|min:3|max:191',
            'criteria_code' => 'required|string|min:2|max:20',
        ]);

        if ($validation->fails()) {
            notify()->error($validation->errors()->first());
            return back();
        }

        $criteria = Criteria::find($id);

        if (! $criteria) {
            notify()->error('Kriteria tidak ditemukan');
            return back();
        }

        $criteria->update([
            'criteria_name' => $request->criteria_name,
            'criteria_code' => $request->criteria_code,
        ]);

        notify()->success('Kriteria berhasil diperbarui');
        return redirect()->route('criteria.index');
    }

    public function destroy($id)
    {
        Gate::authorize('criteria.destroy');

        $criteria = Criteria::find($id);

        if (! $criteria) {
            notify()->error('Kriteria tidak ditemukan');
            return back();
        }

        $criteria->delete();

        notify()->success('Kriteria berhasil dihapus');
        return back();
    }
}
