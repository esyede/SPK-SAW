<?php

namespace App\Http\Requests\Menus;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateMenuItemRequest extends FormRequest
{
    public function authorize()
    {
        Gate::authorize('app.menus.edit');
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|unique:menu_items,title,'.request('itemId'),
            'url' => 'required|string|unique:menu_items,url,'.request('itemId'),
            'target' => 'required|string',
            'icon_class' => 'nullable|string',
        ];
    }
}
