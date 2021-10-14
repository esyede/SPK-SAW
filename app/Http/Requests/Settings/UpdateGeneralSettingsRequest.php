<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateGeneralSettingsRequest extends FormRequest
{
    public function authorize()
    {
        Gate::authorize('app.settings.update');
        return true;
    }

    public function rules()
    {
        return [
            'site_title' => 'string|min:2|max:255',
            'site_description' => 'string|nullable|min:2|max:255',
            'site_address' => 'nullable|string|min:2|max:255',
        ];
    }
}
