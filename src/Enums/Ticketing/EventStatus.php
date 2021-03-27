<?php

namespace Bitsika\Artemis\Enums\Ticketing;

final class EventStatus
{

    const Active    = 1;
    const OnHold    = 2;
    const Cancelled = 3;

    public static function getDescription($value): string
    {
        switch ($value)
        {
            case self::Active:
                return 'Active';
                break;
            case self::OnHold:
                return 'Inactive';
                break;
            case self::Cancelled:
                return 'Cancelled';
                break;
            default:
                return '';
        }
    }

}
