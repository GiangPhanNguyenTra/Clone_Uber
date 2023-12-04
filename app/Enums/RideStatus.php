<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class RideStatus extends Enum
{
    const WAITING = 0;
    const IN_PROGRESS = 1;
    const COMPLETED = 2;

    public static function getDescription($status): string
    {
        switch ($status) {
            case self::WAITING:
                return 'Đang đợi tài xế';
            case self::IN_PROGRESS:
                return 'Chuyến xe đang được thực hiện';
            case self::COMPLETED:
                return 'Chuyến xe đã hoàn thành';
            // Thêm các mô tả khác nếu cần
            default:
                return 'Trạng thái không xác định';
        }

        return parent::getDescription($status);
    }
}
