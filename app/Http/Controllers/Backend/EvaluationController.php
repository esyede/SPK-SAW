<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Evaluation\StoreEvaluationRequest;
use App\Models\User;
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

        return view('backend.evaluation.create', compact('employee'));
    }
}
