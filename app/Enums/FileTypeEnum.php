<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class FileTypeEnum extends Enum
{
    public const IDENTITY = 1;
    public const LICENSE_CAR = 2;
    public const LICENSE_PLATE = 3;
    public const CAR_IMAGE = 4;
    public const BILL_IMAGE = 5;
}
