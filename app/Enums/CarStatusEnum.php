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
    public const READY       = 0;
    public const MAINTENANCE = 1;

    public static function getArrayView(): array
    {
        return [
            self::READY       => 'Sẵn sàng',
            self::MAINTENANCE => 'Bảo dưỡng',
        ];
    }

    public static function getValueByKey($key): string
    {
        return self::getArrayView()[$key];
    }
}
