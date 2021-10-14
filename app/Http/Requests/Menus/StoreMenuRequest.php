<?php

namespace App\Http\Requests\Menus;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreMenuRequest extends FormRequest
{
    public function authorize()
    {
        Gate::authorize('app.menus.create');
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|unique:menus',
            'description' => 'nullable|string'
        ];
    }
}
