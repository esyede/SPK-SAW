<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        Gate::authorize('users.create');
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:100',
            'username' => 'required|string|username|min:3|max:100|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required',
            'avatar' => 'required|image',
        ];
    }
}
