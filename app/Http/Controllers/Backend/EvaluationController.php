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
use DB;
use Validator;

class EvaluationController extends Controller
{
    protected $evaluationRepository;

    public function index()
    {
        $evaluates = PerformanceAssessment::with(['criteria','subcriteria','users','integrity_mappping'])->orderby('id','desc')->get();
        return view('backend.evaluation.index', compact('evaluates'));
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
        $validate = Validator::make($request->all(), [
            'employee_number' => 'required|integer',
        ]);

        if (!$validate) {
            notify()->error($validate->errors()->first());
        }

        $user = User::where('registration_code', $request->employee_number)->first();

        if (!$user) {
            notify()->error('User / Pegawai tidak ditemukan');
        }

        DB::beginTransaction();

        try {
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

            DB::commit();
            notify()->success('Gap sukses di hitung!');

            return redirect('/users');
        } catch(\Exception $e) {
            DB::rollback();
            notify()->error('Terjadi Kesalahan');

            return redirect()->back();
        }
    }

    protected function storeToIntegrityMapping($user_id)
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

    public function UpdateEvaluate(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'performance_assessment_id' => 'required|integer',
            'employee_number' => 'required|integer',
            'attribute_value' => 'required|integer|min:1,max:5'
        ]);

        $evaluate = PerformanceAssessment::find($request->performace_assessment_id);

        if (!$evaluate) {
            return response()->json(['success' => false, 'message' => 'Data nilai tidak ditemukan'],500);
        }

        DB::beginTransaction();
        try {

            $evaluate->attribute_value = $request->attribute_value;
            $evaluate->gap             = intval($request->attribute_value) - intval($evaluate->subcriteria_standard_value);
            $evaluate->save();
            DB::commit();

            notify()->success('Berhasil mengubah data penilaian');

            return redirect()->back();

        } catch (\Exception $e) {
            DB::rollback();

            notify()->error('Terjadi Kesalahan');
            return redirect()->back();
        }
    }

    protected function updateToIntegrityMapping(integer $user_id, integer $evaluate_id)
    {
        $performance = PerformanceAssessment::selectRaw('performance_assessments.*, integrities.id as integrity_id, integrities.integrity, integrities.description')
            ->join('integrities', 'integrities.difference_value', '=', 'performance_assessments.gap')
            ->where('id', $evaluate_id)
            ->where('performance_assessments.user_id', $user_id)
            ->first();

        $integrityMapping = IntegrityMapping::find($performance->id);

        if (!$integrityMapping) {
            notify()->error('Data Penilaian tidak ditemukan');
        }

        $integrityMapping->integrity_id  = $performance->integrity_id;
        $integrityMapping->value         = $performance->integrity;
        $integrityMapping->save();
    }



    public function destroy($id)
    {
        $evaluate = PerformanceAssessment::find($id);

        if (!$evaluate) {
            notify()->error('Data Penilaian tidak ditemukan');
        }

        $evaluate->delete();

        notify()->success('Berhasil menghapus data penilaian');

        return redirect()->back();
    }
}
