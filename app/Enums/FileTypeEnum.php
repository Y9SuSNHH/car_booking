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
    public const IDENTITY_FRONT    = 1;
    public const IDENTITY_BACK     = 2;
    public const LICENSE_CAR_FRONT = 3;
    public const LICENSE_CAR_BACK  = 4;
    public const CAR_IMAGE         = 5;
    public const BILL_IMAGE        = 6;
}
