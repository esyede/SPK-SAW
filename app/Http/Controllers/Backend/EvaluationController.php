<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Evaluation\StoreEvaluationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class EvaluationController extends Controller
{
    public function index()
    {
        return view('backend.evaluation.index');
    }

    public function create()
    {
        Gate::authorize('evaluation.create');

        return view('backend.evaluation.create');
    }
}
