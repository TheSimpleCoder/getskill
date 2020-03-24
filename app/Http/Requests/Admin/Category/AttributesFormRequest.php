<?php

namespace App\Http\Requests\Admin\Category;

use App\Model\Category\Entity\Attribute;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class AttributesFormRequest extends FormRequest
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
            'type' => ['required', 'string', 'max:255', Rule::in(array_keys(Attribute::typesList()))],
            'required' => 'accepted',
            'variants' => 'nullable|string',
            'sort' => 'required|integer',
        ];
    }
}
