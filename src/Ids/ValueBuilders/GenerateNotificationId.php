<?php

namespace DVSA\CPMS\Notifications\Ids\ValueBuilders;

use DVSA\CPMS\Notifications\Exceptions\E5xxCannotGenerateNotificationId;
use Exception;
use Ramsey\Uuid\Uuid;

/**
 * utility class for
 */
class GenerateNotificationId
{
    /**
     * generate a new notification ID
     *
     * @return string
     *         the notification ID as a printable ASCII string
     */
    public function __invoke()
    {
        return self::now();
    }

    /**
     * generate a new notification ID
     *
     * @return string
     *         the notification ID as a printable ASCII string
     */
    public static function now()
    {
        try {
            $id = Uuid::uuid1();
            return $id->toString();
        } catch (Exception $e) {
            throw new E5xxCannotGenerateNotificationId($e->getMessage());
        }
    }
}
