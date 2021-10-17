<?php

namespace App\Http\Requests\Pages;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdatePageRequest extends FormRequest
{
    public function authorize()
    {
        Gate::authorize('pages.edit');
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string',
            'slug' => 'required|string|unique:pages,slug,' . request()->route('page')->id,
            'body' => 'required|string',
            'image' => 'nullable|image'
        ];
    }
}
