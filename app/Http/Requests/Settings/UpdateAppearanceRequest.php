<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateAppearanceRequest extends FormRequest
{
    public function authorize()
    {
        Gate::authorize('settings.update');
        return true;
    }

    public function rules()
    {
        return [
            'site_logo' => 'nullable|image',
            'site_favicon' => 'nullable|image',
        ];
    }
}
