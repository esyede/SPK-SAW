<?php

namespace App\Http\Requests\Criteria;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreCriteriaRequest extends FormRequest
{
    public function authorize()
    {
        Gate::authorize('app.criteria.create');
        return true;
    }

    public function rules()
    {
        return [
            'nama_kriteria' => 'required|string',
            'kode_kriteria' => 'required|string',
        ];
    }
}
