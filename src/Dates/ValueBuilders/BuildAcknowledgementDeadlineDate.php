<?php

namespace DVSA\CPMS\Notifications\Dates\ValueBuilders;

use DateInterval;
use DateTime;

/**
 * creates the date for the acknowledge_by field for Notifications
 */
class BuildAcknowledgementDeadlineDate
{
    /**
     * returns the date/time when a notification needs to be acknowledged by
     *
     * @param  DateInterval  $timeout
     *         the length of the timeout
     * @param  DateTime|null $from
     *         when to calculate the deadline from
     *         if null, we use the current date/time
     * @return DateTime
     *         when the notification needs to be acknowledged by
     */
    public function __invoke(DateInterval $timeout, DateTime $from = null)
    {
        return self::from($timeout, $from);
    }

    /**
     * returns the date/time when a notification needs to be acknowledged by
     *
     * @param  DateInterval  $timeout
     *         the length of the timeout
     * @param  DateTime|null $from
     *         when to calculate the deadline from
     *         if null, we use the current date/time
     * @return DateTime
     *         when the notification needs to be acknowledged by
     */
    public static function from(DateInterval $timeout, DateTime $from = null)
    {
        if (null === $from) {
            $from = new DateTime();
        }

        $deadline = clone $from;
        $deadline->add($timeout);

        return $deadline;
    }
}
