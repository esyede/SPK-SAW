<?php

namespace App\Http\Requests\Roles;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreRoleRequest extends FormRequest
{
    public function authorize()
    {
        Gate::authorize('app.roles.create');
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:roles',
            'permissions.*' => 'integer',
            'permissions' => 'required|array',
        ];
    }
}
