<?php

namespace App\Http\Requests\Integrity;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateIntegrityRequest extends FormRequest
{
    public function authorize()
    {
        Gate::authorize('integrity.edit');
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
