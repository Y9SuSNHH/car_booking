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
    public const READY = 0;
    public const MAINTENANCE = 1;

    public static function getArrayView(): array
    {
        return [
            'Sẵn sàng'  => self::READY,
            'Bảo dưỡng' => self::MAINTENANCE,
        ];
    }

    public static function getKeyByValue($value)
    {
        return array_search($value, self::getArrayView(), true);
    }
}
