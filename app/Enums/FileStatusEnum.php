<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class FileStatusEnum extends Enum
{
    public const NO_PHOTO = 0;
    public const PENDING  = 1;
    public const APPROVED = 2;

    public static function getArrayView(): array
    {
        return [
            self::NO_PHOTO => 'Chưa có ảnh',
            self::PENDING  => 'Ảnh chưa duyệt',
            self::APPROVED => 'Ảnh đã duyệt',
        ];
    }

    public static function getValueByKey($key): string
    {
        return self::getArrayView()[$key];
    }
}
