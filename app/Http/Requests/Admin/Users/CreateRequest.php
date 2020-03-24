<?php

namespace App\Http\Requests\Admin\Users;

use App\Model\User\Entity\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class CreateRequest
 * @property $name
 * @property $email
 * @property $type
 * @property $role
 */

class CreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'type' => ['required', 'string', Rule::in(array_keys(User::typeList()))],
            'role' => ['required', 'string', Rule::in(array_keys(User::rolesList()))],
        ];
    }
}
