<?php

namespace App\Model\Category\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $category_id
 * @property string $name_ru
 * @property string $name_uk
 * @property string $type
 * @property boolean $required
 * @property array $variants
 * @property integer $sort
 */
class Attribute extends Model
{
    public const TYPE_STRING = 'string';
    public const TYPE_INTEGER = 'integer';
    public const TYPE_FLOAT = 'float';

    protected $table = 'course_attributes';

    public $timestamps = false;

    protected $fillable = ['name_ru', 'name_uk','type', 'required', 'variants', 'sort'];

    protected $casts = [
        'variants' => 'array',
    ];

    public static function typesList(): array
    {
        return [
            self::TYPE_STRING => 'Строка (String)',
            self::TYPE_INTEGER => 'Целое число (Integer)',
            self::TYPE_FLOAT => 'Дробное число (Float)',
        ];
    }

    public function isString(): bool
    {
        return $this->type === self::TYPE_STRING;
    }

    public function isInteger(): bool
    {
        return $this->type === self::TYPE_INTEGER;
    }

    public function isFloat(): bool
    {
        return $this->type === self::TYPE_FLOAT;
    }

    public function isNumber(): bool
    {
        return $this->isInteger() || $this->isFloat();
    }

    public function isSelect(): bool
    {
        return count($this->variants) > 1;
    }


    public function getRequiredText(): string
    {
        return $this->required ? 'Да' : 'Нет';
    }

}
