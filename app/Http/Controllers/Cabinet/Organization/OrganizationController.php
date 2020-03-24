<?php

namespace App\Http\Controllers\Cabinet\Organization;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\AppController;
use App\Http\Requests\User\Profile\ChangeEmailRequest;
use App\Http\Requests\User\Profile\ChangePasswordRequest;
use App\Http\Requests\User\Profile\ProfileEditRequest;
use App\UseCases\User\Profile\ProfileService;
use Illuminate\Support\Facades\Auth;
use Favorite;

class OrganizationController extends Controller
{
    private $service;

    public function __construct(ProfileService $service)
    {
        $this->service = $service;
    }

    public function setting()
    {
        $user = Auth::user();
        return view('cabinet.organization.setting.setting', compact('user'));
    }

    public function update(ProfileEditRequest $request)
    {
        try {
            $this->service->edit(Auth::id(), $request);
        } catch (\DomainException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        return redirect()->route('cabinet.organization.profile.setting', app()->getLocale())
            ->with('success', trans('cabinet/person/profile/home.Success edit profile'));
    }

    public function deleteImage()
    {
        $user = Auth::user();

        $user->deletePhoto();
        $user->update(['image' => null]);

        return redirect()->route('cabinet.organization.profile.setting', app()->getLocale())
            ->with('success', trans('cabinet/person/profile/home.Delete image success message'));
    }

    public function changePasswordShowForm()
    {
        return view('cabinet.organization.setting.password');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        try {
            $this->service->changePassword(Auth::user(), $request);
        } catch (\DomainException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        return redirect()->route('cabinet.organization.profile.setting', app()->getLocale())
            ->with('success', trans('cabinet/person/profile/change-password.Password success changed'));
    }

    public function changeEmailShowForm()
    {
        return view('cabinet.organization.setting.email');
    }

    public function changeEmail(ChangeEmailRequest $request)
    {
        try {
            $this->service->changeEmailRequest(Auth::user(), $request->email);
        } catch (\DomainException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        return redirect()->route('cabinet.organization.profile.setting', app()->getLocale())
            ->with('success', trans('cabinet/person/profile/change-email.Email changed success request'));
    }

    public function favorite()
    {
        foreach ($_COOKIE as $key => $value) {
            $info = explode('-', $key);

            if(isset($info[1]) AND isset($info[2])){
                Favorite::create(['user_id' => Auth::user()->id, 'course_id' => $info[2], 'type' => $info[1]]);
                setcookie ($key,$info[2],time()-3600,"/"); 
            }
        }

        $favorites = Favorite::where('user_id', Auth::user()->id);

        return view('cabinet.organization.setting.favorite', compact('favorites'));
    }
}
