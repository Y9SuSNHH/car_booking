<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class FileTableEnum extends Enum
{
    public const USERS = 0;
    public const CARS = 1;
    public const BILLS = 2;
}
