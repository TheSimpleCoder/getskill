<?php

namespace App\Http\Requests\Admin\Publisher\Category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name_ru' => 'required|string|max:255',
            'name_uk' => 'required|string|max:255',
            'description_ru' => 'nullable|string',
            'description_uk' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,svg',
            'meta_title_ru' => 'nullable|string|max:255',
            'meta_title_uk' => 'nullable|string|max:255',
            'meta_description_ru' => 'nullable|string|max:255',
            'meta_description_uk' => 'nullable|string|max:255',
            'meta_keywords_ru' => 'nullable|string|max:255',
            'meta_keywords_uk' => 'nullable|string|max:255',
            'parent' => 'nullable|integer|exists:publisher_categories,id',
        ];


    }
}
