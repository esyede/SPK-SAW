<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Evaluation\StoreEvaluationRequest;
use App\Models\{
    User,
    Criteria,
    IntegrityMapping,
    PerformanceAssessment,
    SubCriteria,
    ConvertionIntegrityMapping
};
use CreatePerformanceAssessmentsTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class EvaluationController extends Controller
{
    public function index()
    {
        return view('backend.evaluation.index');
    }

    public function evaluate($id)
    {
        $employee = User::findOrFail($id);
        $criteria = Criteria::with('sub_criteria')->get();
        $performanceAssess = PerformanceAssessment::where('user_id', $id)->first();

        return view('backend.evaluation.create', compact('employee', 'criteria', 'performanceAssess'));
    }

    public function storeEvaluate(Request $request)
    {
        $user = User::where('registration_code', $request->employee_number)->first();

        if (!$user) {
            notify()->error('User / Pegawai tidak ditemukan');
        }

        foreach ($request->except('employee_number', '_token') as $name => $val) {
            $name = explode('_', $name);

            $subcriteria = SubCriteria::with('criteria')->where('subcriteria_code', $name[1])->first();

            // Input nilai atribut setiap karyawan dan hitung nilai gap lalu masukkan ke DB performance_assessments
            $evaluate = PerformanceAssessment::create([
                'subcriteria_standard_value' => $subcriteria->standard_value,
                'subcriteria_code' => $subcriteria->subcriteria_code,
                'attribute_value' => $val,
                'criteria_id' => $subcriteria->criteria->id,
                'user_id' => $user->id,
                'gap' => intval($val) - intval($subcriteria->standard_value),
            ]);
        }

        notify()->success('Gap sukses di hitung!');

        return redirect('/users');
    }
}
