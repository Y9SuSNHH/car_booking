<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class CarTypeEnum extends Enum
{
    public const MINI        = 1;
    public const SEDAN       = 2;
    public const HATCHBACK   = 3;
    public const LOW_GROUND  = 4;
    public const HIGH_GROUND = 5;
    public const TRUCK       = 6;

    public static function getArrayView(): array
    {
        return [
            self::MINI        => 'Mini',
            self::SEDAN       => 'Sedan',
            self::HATCHBACK   => 'Hatchback',
            self::LOW_GROUND  => 'Gầm thấp',
            self::HIGH_GROUND => 'Gầm cao',
            self::TRUCK       => 'Bán tải',
        ];
    }


    public static function getValueByKey($key)
    {
        return self::getArrayView()[$key];
    }
}
