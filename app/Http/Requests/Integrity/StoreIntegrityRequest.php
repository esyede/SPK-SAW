<?php

namespace App\Http\Requests\Integrity;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreIntegrityRequest extends FormRequest
{
    public function authorize()
    {
        Gate::authorize('integrity.create');
        return true;
    }

    public function rules()
    {
        return [
            'description' => 'required|string',
            'integrity' => 'required|numeric',
            'difference_value' => 'required|numeric',
        ];
    }
}
