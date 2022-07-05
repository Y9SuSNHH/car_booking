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
    public const USERS = 1;
    public const CARS = 2;
    public const BILLS = 3;
}
