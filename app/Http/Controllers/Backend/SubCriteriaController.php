<?php

namespace App\Http\Controllers\Backend;

use App\Models\Role;
use App\Models\Criteria;
use App\Models\SubCriteria;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use DB;
use Exception;
use Log;

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

        $validator = Validator::make($request->all(), [
            'criteria_id'       => 'required|integer|exists:criterias,id',
            'subcriteria_code'  => 'required|string|max:255|unique:sub_criterias,subcriteria_code',
            'name'              => 'required|string|max:255',
            'standard_value'    => 'required|integer',
            'factor'            => 'required|string',
            'weight'            => 'required|integer',
        ]);

        if ($validator->fails()) {
            notify()->error($validator->errors()->first());
            return back();
        }

        if ($request->weight >= 100) {
            notify()->error('Total nilai bobot sudah melebihi 100, Silahkan atur ulang');
            return back();
        }

        try {
            DB::beginTransaction();

            $subcriteria = SubCriteria::create([
                'criteria_id'       => $request->criteria_id,
                'subcriteria_code'  => Str::upper($request->subcriteria_code),
                'name'              => $request->name,
                'standard_value'    => $request->standard_value,
                'factor'            => $request->factor,
                'weight'            => $request->weight,
            ]);

            $weight = SubCriteria::sum('weight');
        
            if ($weight > 100) {
                throw new Exception('Total nilai bobot sudah melebihi 100, Silahkan atur ulang');
            }

            DB::commit();

            if ($subcriteria) {
                notify()->success('Berhasil mengubah data Sub Kriteria');
            } else {
                throw new Exception('Gagal menambahkan Sub Kriteria');
            }

            return redirect()->route('sub-criteria.index');
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e);

            notify()->error($e->getMessage());
            return back();
        }
    }

    public function edit($id)
    {
        Gate::authorize('sub-criteria.edit');

        $criteria = Criteria::all();
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
            'standard_value'    => 'required|integer',
            'factor'            => 'required|string',
            'weight'            => 'required|integer',
        ]);

        if ($validate->fails()) {
            notify()->error($validate->errors()->first());
            return back();
        }

        if ($request->weight >= 100) {
            notify()->error('Total nilai bobot sudah melebihi 100, Silahkan atur ulang');
            return back();
        }

        try {
            DB::beginTransaction();

            $subcriteria = SubCriteria::find($id);

            if (! $subcriteria) {
                notify()->error('Sub Kriteria tidak ditemukan');
                return back();
            }

            $subcriteria->update([
                'criteria_id'       => $request->criteria_id,
                'subcriteria_code'  => $request->subcriteria_code,
                'name'              => $request->name,
                'standard_value'    => $request->standard_value,
                'factor'            => $request->factor,
                'weight'            => $request->weight,
            ]);

            $weight = SubCriteria::sum('weight');
        
            if ($weight > 100) {
                throw new exception('Total nilai bobot sudah melebihi 100, Silahkan atur ulang');
            }

            DB::commit();

        if (!$subcriteria) {
            notify()->error('Sub Kriteria tidak ditemukan');
            return back();
        }
            if ($subcriteria) {
                notify()->success('Berhasil mengubah data Sub Kriteria');
            } else {
                throw new exception('Gagal mengubah data Sub Kriteria');
            }


            return redirect()->route('sub-criteria.index');
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e);

            notify()->error($e->getMessage());
            return back();
        }
    }

    public function destroy($id)
    {
        Gate::authorize('sub-criteria.destroy');

        $subcriteria = SubCriteria::find($id);

        if (!$subcriteria) {
            notify()->error('Sub Kriteria gagal dihapus');
            return back();
        }

        $subcriteria->delete();

        notify()->success('Sub Kriteria berhasil dihapus');
        return back();
    }
}
