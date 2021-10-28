<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\{
    User,
    Criteria,
    PerformanceAssessment,
    SubCriteria,
    Integrity,
};
use App\Repository\EvaluationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EvaluationController extends Controller
{
    protected $evaluationRepository;

    public function index()
    {
        $users = User::where('role_id', 2)->get();
        return view('backend.evaluation.index', compact('users'));
    }

    public function detailEvaluation($id)
    {
        $evaluates = PerformanceAssessment::with('criteria', 'subcriteria', 'users')->where('user_id', $id)->get();

        return view('backend.evaluation.detail-evaluation', compact('evaluates'));
    }

    public function evaluate($id)
    {
        $employee = User::findOrFail($id);
        $criteria = Criteria::with('sub_criteria')->get();

        return view('backend.evaluation.create', compact('employee', 'criteria'));
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
                    'attribute_value'               => intval($val),
                    'integrity_id'                  => $user->id,
                    'criteria_id'                   => $subcriteria->criteria->id,
                    'user_id'                       => $user->id,
                    'gap'                           => intval($val) - intval($subcriteria->standard_value),
                ]);

                $performance = PerformanceAssessment::dataPerformanceAssessment($user->id);

                foreach ($performance as $item) {
                    $evaluate->update([
                        'convertion_value' => $item->integrity,
                        'integrity_id' => $item->integrity_id
                    ]);
                }
            }

            DB::commit();
            notify()->success('Gap sukses di hitung!');

            return redirect('/users');
        } catch (\Exception $e) {
            DB::rollback();
            notify()->error('Terjadi Kesalahan');

            return back();
        }
    }

    public function edit(Request $request, $id)
    {
        $evaluate = PerformanceAssessment::with('criteria', 'subcriteria', 'users')
                                            ->where('subcriteria_code', $id)
                                            ->first();
     
        return view('backend.evaluation.form', compact('evaluate'));
    }

    public function updateEvaluate(Request $request, $id)
    {

        $validate = Validator::make($request->all(), [
            'performance_assessment_id' => 'required|integer',
            'employee_number' => 'required|integer',
            'attribute_value' => 'required|integer|min:1,max:5'
        ]);

        $evaluate = PerformanceAssessment::find($id);

        if (!$evaluate) {
            return response()->json(['success' => false, 'message' => 'Data nilai tidak ditemukan'], 500);
        }

        DB::beginTransaction();
        try {

            $evaluate->attribute_value = $request->attribute_value;
            $evaluate->gap             = intval($request->attribute_value) - intval($evaluate->subcriteria_standard_value);
            $evaluate->save();

            $performance = PerformanceAssessment::dataPerformanceAssessment($request->user_id);

            foreach ($performance as $item) {
                $evaluate->update([
                    'convertion_value' => $item->integrity
                ]);
            }

            DB::commit();

            notify()->success('Berhasil mengubah data penilaian');

            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();

            notify()->error('Terjadi Kesalahan');
            return redirect()->back();
        }
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
