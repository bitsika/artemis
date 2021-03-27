<?php

namespace Bitsika\Artemis\Enums\Ticketing;

final class EventVerification
{
    const Pending       = 1;
    const Verified      = 2;
    const NotVerified   = 3;
    const Rejected      = 4;

    public static function getDescription($value): string
    {
        switch ($value)
        {
            case self::Pending:
                return 'Pending';
                break;
            case self::Verified:
                return 'Verified';
                break;
            case self::NotVerified:
                return 'Not Verified';
                break;
            case self::Rejected:
                return 'Rejected';
                break;
            default:
                return '';
        }
    }

}
