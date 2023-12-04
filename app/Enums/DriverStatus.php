<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class DriverStatus extends Enum
{
    const FREE = 0;
    const DOING = 1;

    public static function getDescription($status): string
    {
        switch ($status) {
            case self::FREE:
                return 'Đang rảnh';
            case self::DOING:
                return 'Đang có khách';
            default:
                return 'Trạng thái không xác định';
        }

        return parent::getDescription($status);
    }
}
