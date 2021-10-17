<?php

namespace App\Http\Requests\Pages;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StorePageRequest extends FormRequest
{
    public function authorize()
    {
        Gate::authorize('pages.create');
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string',
            'slug' => 'required|string|unique:pages',
            'body' => 'required|string',
            'image' => 'nullable|image'
        ];
    }
}
