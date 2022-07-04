<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class UserRoleEnum extends Enum
{
    public const ADMIN = 0;
    public const STAFF = 1;
    public const USER = 2;

    public static function getArrayView():array
    {
        return [
            'Quản lý' => self::ADMIN,
            'Nhân viên' => self::STAFF,
            'Khách hàng' => self::USER,
        ];
    }

    public static function getKeyByValue($value)
    {
        return array_search($value, self::getArrayView(),true);
    }
}
