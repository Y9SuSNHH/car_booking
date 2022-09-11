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
    public const USER  = 2;

    public static function getArrayView(): array
    {
        return [
            self::ADMIN => 'Quản lý',
            self::STAFF => 'Nhân viên',
            self::USER  => 'Khách hàng',
        ];
    }

    public static function getValueByKey($key): string
    {
        return self::getArrayView()[$key];
    }
}
