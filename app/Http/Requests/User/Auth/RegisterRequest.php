<?php

namespace App\Http\Requests\User\Auth;

use App\Model\User\Entity\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class RegisterRequest extends FormRequest
{
    public function authorize() :bool
    {
        return true;
    }


    public function rules() :array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'type' => ['required', 'string', Rule::in(array_keys(User::typeList()))],
            'policy' => 'accepted',
        ];
    }
}
