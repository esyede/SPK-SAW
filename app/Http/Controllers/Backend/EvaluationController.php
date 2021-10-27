<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\{
    User,
    Criteria,
    PerformanceAssessment,
    SubCriteria,
    Integrity,
    IntegrityMapping,
    ConvertionIntegrityMapping
};
use App\Repository\EvaluationRepository;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    protected $evaluationRepository;

    public function __construct(EvaluationRepository $evaluationRepository)
    {
        $this->evaluationRepository = $evaluationRepository;
    }

    public function index()
    {
        $this->evaluationRepository->findAll();
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
                'subcriteria_standard_value'    => $subcriteria->standard_value,
                'subcriteria_code'              => $subcriteria->subcriteria_code,
                'attribute_value'               => $val,
                'criteria_id'                   => $subcriteria->criteria->id,
                'user_id'                       => $user->id,
                'gap'                           => intval($val) - intval($subcriteria->standard_value),
            ]);
        }

        $integrityMapping = $this->storeToIntegrityMapping($user->id);

        notify()->success('Gap sukses di hitung!');

        return redirect('/users');
    }

    public function storeToIntegrityMapping($user_id)
    {
        $performance = PerformanceAssessment::selectRaw('performance_assessments.*, integrities.id as integrity_id, integrities.integrity, integrities.description')
            ->join('integrities', 'integrities.difference_value', '=', 'performance_assessments.gap')
            ->where('performance_assessments.user_id', $user_id)
            ->get();

        foreach ($performance as $item) {
            $integrityMapping = IntegrityMapping::create([
                'performance_assessment_id' => $item->id,
                'integrity_id' => $item->integrity_id,
                'user_id' => $user_id,
                'value' => $item->integrity,
            ]);
        }
    }
}
