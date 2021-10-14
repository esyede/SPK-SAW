<?php

namespace App\Http\Requests\Roles;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateRoleRequest extends FormRequest
{
    public function authorize()
    {
        Gate::authorize('app.roles.edit');
        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'unique:roles,name,'.request()->route('role')->id
            ],
            'permissions.*' => [
                'integer',
            ],
            'permissions' => [
                'required',
                'array',
            ],
        ];
    }
}
