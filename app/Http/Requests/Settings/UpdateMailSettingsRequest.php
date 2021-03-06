<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateMailSettingsRequest extends FormRequest
{
    public function authorize()
    {
        Gate::authorize('settings.update');
        return true;
    }

    public function rules()
    {
        return [
            'mail_mailer' => 'string|max:255',
            'mail_host' => 'nullable|string|max:255',
            'mail_port' => 'nullable|numeric',
            'mail_username' => 'nullable|string|max:255',
            'mail_password' => 'nullable|max:255',
            'mail_encryption' => 'nullable|string|max:255',
            'mail_from_address' => 'nullable|email|max:255',
            'mail_from_name' => 'nullable|string|max:255',
        ];
    }
}
