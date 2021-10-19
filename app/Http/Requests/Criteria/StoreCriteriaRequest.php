<?php

namespace App\Http\Requests\Criteria;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreCriteriaRequest extends FormRequest
{
    public function authorize()
    {
        Gate::authorize('criteria.create');
        return true;
    }

    public function rules()
    {
        return [
            'criteria_name' => 'required|string',
            'criteria_code' => 'required|string',
        ];
    }
}
