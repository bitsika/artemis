<?php

namespace Bitsika\Artemis\Enums\Ticketing;

final class TicketStatus
{
    const Used      = 1;
    const Valid     = 2;
    const Reserved  = 3;

    public static function getDescription($value): string
    {
        switch ($value)
        {
            case self::Used:
                return 'Used';
                break;
            case self::Valid:
                return 'Valid (Has not been used)';
                break;
            case self::Reserved:
                return 'Reserved';
                break;
            default:
                return '';
        }
    }

}
