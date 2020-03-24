<?php

namespace App\Model\Region\Helper;


class AdminHelper
{


    public static function getFormLabel(string $attribute): string
    {
        $labels = [
            'name_ru' => 'Название на русском',
            'name_uk' => 'Название на уркаинском',
            'slug' => 'Алиас',
        ];

        if (!in_array($attribute, array_keys($labels))){
            throw new \DomainException('Неверный атрибут');
        }

        return $labels[$attribute];
    }
}
