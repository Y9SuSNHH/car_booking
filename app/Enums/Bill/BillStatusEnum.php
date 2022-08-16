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
    public const PENDING = 0;
    public const ACCEPT = 1;
    public const DONE = 2;
}
