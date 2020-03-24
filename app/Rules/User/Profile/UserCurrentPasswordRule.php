<?php

namespace App\Rules\User\Profile;

use Illuminate\Contracts\Validation\Rule;

class UserCurrentPasswordRule implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $user = auth()->user();
        if (password_verify($value, $user->password)) {
            return true;
        }
        return false;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */

    public function message()
    {
        return trans('cabinet/person/profile/change-password.Current password error');
    }
}
