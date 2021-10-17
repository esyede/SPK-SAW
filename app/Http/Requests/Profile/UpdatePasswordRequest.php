<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdatePasswordRequest extends FormRequest
{
    public function authorize()
    {
        Gate::authorize('profile.password');
        return true;
    }

    public function rules()
    {
        return [
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ];
    }
}
