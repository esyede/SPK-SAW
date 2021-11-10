<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

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
            'registration_code' => 'required|integer|unique:'.User::class.',registration_code',
            'name' => 'required|string|min:3|max:100',
            'username' => 'required|string|username|min:3|max:100|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required',
            'avatar' => 'required|image',
        ];
    }
}
