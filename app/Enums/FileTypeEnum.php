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
    public const IDENTITY = 0;
    public const LICENSE_CAR = 1;
    public const LICENSE_PLATE = 2;
    public const CAR_IMAGE = 2;
    public const BILL_IMAGE = 3;
}
