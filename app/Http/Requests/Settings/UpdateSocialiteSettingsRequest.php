<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateSocialiteSettingsRequest extends FormRequest
{
    public function authorize()
    {
        Gate::authorize('settings.update');
        return true;
    }

    public function rules()
    {
        return [
            'facebook_client_id' => 'string|nullable',
            'facebook_client_secret' => 'string|nullable',

            'google_client_id' => 'string|nullable',
            'google_client_secret' => 'string|nullable',

            'github_client_id' => 'string|nullable',
            'github_client_secret' => 'string|nullable',
        ];
    }
}
