<?php

namespace App\Enums\Bill;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class BillStatusEnum extends Enum
{
    public const PENDING  = 0;
    public const ACCEPTED = 1;
    public const DONE     = 2;
    public const EXPIRES  = 3;

    public static function getArrayView(): array
    {
        return [
            self::PENDING  => 'Đặt xe',
            self::ACCEPTED => 'Đã giao xe',
            self::DONE     => 'Hoàn thành',
        ];
    }

    public static function getValueByKey($key): string
    {
        return self::getArrayView()[$key];
    }
}
