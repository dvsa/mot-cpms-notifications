<?php

namespace DVSA\CPMS\Notifications\Exceptions;

use Exception;
use RuntimeException;

/**
 * exception thrown when we cannot create a mandate notification v1
 *
 * this is normally caused by receiving bad data
 */
final class E4xxCannotCreateMandateNotificationV1 extends RuntimeException
{
    /**
     * constructor
     *
     * @param string $message
     *        the reason why we cannot create a new mandate notification v1
     * @param Exception $cause
     *        the underlying error that we are wrapping
     */
    public function __construct($message, Exception $cause = null)
    {
        parent::__construct($message, 400, $cause);
    }

    /**
     * create a new instance from an existing exception
     *
     * @param  Exception $cause
     *         the exception that caused this error
     * @param  string $message
     *         optional extra information about the error
     * @return E4xxCannotCreateMandateNotificationV1
     */
    public static function newFromException(Exception $cause, $message = '')
    {
        if (!empty($message)) {
            $message = (string)$message . ': ';
        }
        return new self($message . $cause->getMessage(), $cause);
    }

    /**
     * create a new instance when we've been asked to create a mandate
     * notification from bad input data
     *
     * @param  string $message
     *         details about why the response is bad
     * @param  mixed $badData
     *         the bad data that we cannot use
     * @return E4xxCannotCreateMandateNotificationV1
     */
    public static function newFromBadData($message, $badData)
    {
        return new self($message . "; data is: " . json_encode($badData));
    }
}
