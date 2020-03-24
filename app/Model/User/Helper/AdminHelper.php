<?php

namespace App\Model\User\Helper;


use App\Model\User\Entity\User;
use Illuminate\Support\Arr;

class AdminHelper
{


    public static function getFormLabel(string $attribute): string
    {
        $labels = [
            'name' => 'Имя',
            'email' => 'Email',
            'type' => 'Тип',
            'status' => 'Статус',
            'role' => 'Роль',
        ];

        if (!in_array($attribute, array_keys($labels))){
            throw new \DomainException('Неверный атрибут');
        }

        return $labels[$attribute];
    }



    public static function showStatusLabel(User $user): string
    {
        $out = '';

        if ($user->isWait()){
            $out = '<span class="badge badge-secondary">'. Arr::get(User::statusesList(), $user->status) .'</span>';
        }

        if ($user->isActive()){
            $out = '<span class="badge badge-primary">'. Arr::get(User::statusesList(), $user->status) .'</span>';
        }

        return $out;
    }

    public static function showRoleLabel(User $user): string
    {

        $out = '<span class="badge badge-secondary">'. Arr::get(User::rolesList(), $user->role) .'</span>';

        if ($user->isAdmin()){
            $out = '<span class="badge badge-danger">'. Arr::get(User::rolesList(), $user->role) .'</span>';
        }

        if ($user->isModerator()){
            $out = '<span class="badge badge-warning">'. Arr::get(User::rolesList(), $user->role) .'</span>';
        }

        return $out;
    }


    public static function showTypeLabel(User $user): string
    {
        $out = '';

        if ($user->isPerson()){
            $out = '<span class="badge badge-secondary">'. Arr::get(User::typeList(), $user->type) .'</span>';
        }

        if ($user->isOrganization()){
            $out = '<span class="badge badge-primary">'. Arr::get(User::typeList(), $user->type) .'</span>';
        }

        return $out;
    }
}
