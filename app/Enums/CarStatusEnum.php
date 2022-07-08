<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class CarStatusEnum extends Enum
{
    public const GOOD = 1;
    public const MAINTENANCE = 2;

    public static function getArrayView(): array
    {
        return [
            'Sẵn sàng'  => self::GOOD,
            'Bảo dưỡng' => self::MAINTENANCE,
        ];
    }

    public static function getKeyByValue($value)
    {
        return array_search($value, self::getArrayView(), true);
    }
}
