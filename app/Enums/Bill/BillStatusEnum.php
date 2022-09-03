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
    public const ORDER     = 0;
    public const DELIVERED = 1;
    public const EXPIRES       = 2;
    public const DONE      = 3;

    public static function getArrayView(): array
    {
        return [
            'Đặt xe'     => self::ORDER,
            'Đã giao xe' => self::DELIVERED,
            'Quá hạn'    => self::EXPIRES,
            'Hoàn thành' => self::DONE,
        ];
    }

    public static function getKeyByValue($value)
    {
        return array_search($value, self::getArrayView(), true);
    }
}
