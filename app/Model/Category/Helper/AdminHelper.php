<?php

namespace App\Model\Category\Helper;


class AdminHelper
{


    public static function getFormLabel(string $attribute): string
    {
        $labels = [
            'name_ru' => 'Название на русском',
            'name_uk' => 'Название на украинском',
            'slug' => 'Алиас',
            'parent' => 'Родительская категория',
            'image' => 'Изображение',
            'description_ru' => 'Описание на русском',
            'description_uk' => 'Описание на уркаинском',
            'meta_title_ru' => 'SEO заголовок на русском',
            'meta_title_uk' => 'SEO заголовок на уркаинском',
            'meta_description_ru' => 'SEO описание на русском',
            'meta_description_uk' => 'SEO описание на уркаинском',
            'meta_keywords_ru' => 'SEO ключевые слова на русском',
            'meta_keywords_uk' => 'SEO ключевые слова на уркаинском',
        ];

        if (!in_array($attribute, array_keys($labels))){
            throw new \DomainException('Неверный атрибут');
        }

        return $labels[$attribute];
    }

    public static function getAttributeLabel(string $attribute): string
    {
        $labels = [
            'name_ru' => 'Название на русском',
            'name_uk' => 'Название на украинском',
            'type' => 'Тип данных',
            'required' => 'Обязательный атрибут',
            'variants' => 'Варианты',
            'sort' => 'Сортировка',
        ];

        if (!in_array($attribute, array_keys($labels))){
            throw new \DomainException('Неверный атрибут');
        }

        return $labels[$attribute];
    }
}
