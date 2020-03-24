<?php

namespace App\UseCases\User\Profile;

use App\Http\Requests\User\Profile\ChangePasswordRequest;
use App\Model\User\Entity\User;
use App\Http\Requests\User\Profile\ProfileEditRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class ProfileService
{
    public function edit($id, ProfileEditRequest $request): void
    {
        /** @var User $user */
        $user = User::findOrFail($id);
        $image = $request->image;

        if ($image){
            $user->deletePhoto();
        }

        $data = array_filter([
            'name' => $request['name'],
            'phone' => $request['phone'],
            'image' => $image ? $image->store(User::IMAGE_PATH, 'public') : null,
        ]); 

        $user->update($data);
    }



    public function changePassword(User $user, ChangePasswordRequest $request): void
    {
        $user->update(['password'=> Hash::make($request->password)]);
    }


    public function changeEmailRequest(User $user, string $newEmail): void
    {
        $token = Str::random(60) . time();
        $user->requestEmailChanging($newEmail, $token);
    }


    public function confirmNewEmail(string $token): void
    {
        /** @var User $user */
        $user = User::where('new_email_token', $token)->first();

        if (!$user &&  User::where('email', '=', $user->new_email)->exists()) {
            throw new \DomainException(trans('auth/register.Sorry your link cannot be identified.'));
        }

        $user->confirmEmailChanging($token);
    }

}
