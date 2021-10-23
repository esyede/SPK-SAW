<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Evaluation\StoreEvaluationRequest;
use App\Models\{
    User,
    Criteria,
    IntegrityMapping,
    SubCriteria
};
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

        // Gate::authorize('evaluation.create');
        $employee = User::findOrFail($id);

        $criteria = Criteria::with('sub_criteria')->get();

        return view('backend.evaluation.create', compact('employee', 'criteria'));
    }

    public function storeEvaluate(Request $request)
    {
        $gap = $request->segment_tugas;
        $employee_number = User::where('registration_code', $request->employee_number)->first();
        dd($request);

        $evaluate = IntegrityMapping::create([
            'performance_assessment_id' => $employee_number
        ]);
    }
}
