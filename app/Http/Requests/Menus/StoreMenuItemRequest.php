<?php

namespace App\Http\Requests\Menus;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreMenuItemRequest extends FormRequest
{
    public function authorize()
    {
        Gate::authorize('menus.create');
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|unique:menu_items',
            'url' => 'required|string|unique:menu_items',
            'target' => 'required|string',
            'icon_class' => 'nullable|string',
        ];
    }
}
