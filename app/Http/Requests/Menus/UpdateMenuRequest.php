<?php

namespace App\Http\Requests\Menus;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateMenuRequest extends FormRequest
{
    public function authorize()
    {
        Gate::authorize('menus.edit');
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|unique:menus,id,' . request()->route('menu')->id,
            'description' => 'nullable|string'
        ];
    }
}
