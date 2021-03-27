<?php

namespace Bitsika\Artemis\Enums\Ticketing;

final class TicketCategoryStatus
{
    const Active    = 1;
    const Cancelled = 2;

    public static function getDescription($value): string
    {
        switch ($value)
        {
            case self::Active:
                return 'Active';
                break;
            case self::Cancelled:
                return 'Cancelled';
                break;
            default:
                return '';
        }
    }

}
