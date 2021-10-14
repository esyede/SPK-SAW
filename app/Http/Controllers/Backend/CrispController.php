<?php

namespace App\Http\Controllers\Backend;

use App\Models\Crisp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CrispController extends Controller
{
    public function validatorForm($form)
    {
        $validator = Validator::make($form->all(), [
            'nama_crisp' => 'required|unique:crisp,nama_crisp|alpha',
            'nilai_crisp' => 'required|numeric'
        ]);

        return $validator;
    }

    public function index()
    {
        $crisp = Crisp::oldest()->get();

        return response()->json([
            'success' => true,
            'message' => 'List data crisp',
            'data' => $crisp
        ], 200);
    }

    public function show($id)
    {
        $crisp = Crisp::findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Detail data crisp',
            'data' => $crisp
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $this->validatorForm($request);

        if ($validated->fails()) {
            return response()->json($validated->errors(), 400);
        }

        $crisp = Crisp::create([]);
    }
}
