<?php

namespace App\Http\Requests\User\Profile;

use App\Rules\User\Profile\UserCurrentPasswordRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property $current_password
 * @property $password
 * @property $password_confirmation
 */

class ChangePasswordRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'current_password' => ['required', new UserCurrentPasswordRule()],
            'password' => 'required|string|min:6',
            'password_confirmation' => 'required|same:password'
        ];
    }

}

