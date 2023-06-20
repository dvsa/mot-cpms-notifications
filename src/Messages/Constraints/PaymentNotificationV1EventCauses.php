<?php

namespace DVSA\CPMS\Notifications\Messages\Constraints;

class PaymentNotificationV1EventCauses
{
    /**
     * returns a list of all valid values of the 'event_type' field in
     * a notification message
     *
     * @return array<string>
     */
    public static function getAllEventCauses()
    {
        return [
            'confirmed'  => 'confirmed',
            'failed'     => 'failed',
            'cancelled'  => 'cancelled',
        ];
    }
}
