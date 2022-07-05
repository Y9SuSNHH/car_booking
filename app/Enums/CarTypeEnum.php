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
    public const MINI = 1;
    public const SEDAN = 2;
    public const HATCHBACK = 3;
    public const LOW_GROUND = 4;
    public const HIGH_GROUND = 5;
    public const TRUCK = 6;

    public static function getArrayView():array
    {
        return [
            'Mini' => self::MINI,
            'Sedan' => self::SEDAN,
            'Hatchback' => self::HATCHBACK,
            'Gầm thấp' => self::LOW_GROUND,
            'Gầm cao' => self::HIGH_GROUND,
            'Bán tải' => self::TRUCK,
        ];
    }


    public static function getKeyByValue($value)
    {
        return array_search($value, self::getArrayView(),true);
    }
}
