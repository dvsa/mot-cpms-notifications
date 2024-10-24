<?php

namespace DVSA\CPMS\Notifications\Exceptions;

use Exception;
use RuntimeException;

/**
 * exception thrown when we have been asked to build a value from an api
 * response, but we cannot
 *
 * this is normally caused by receiving bad data
 */
class E4xxUnsupportedApiResponse extends RuntimeException
{
    /**
     * constructor
     *
     * @param string $message
     *        the reason why we do not support the API response
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
     * @return E4xxUnsupportedApiResponse
     */
    public static function newFromException(Exception $cause)
    {
        return new static($cause->getMessage(), $cause);
    }

    /**
     * create a new instance when we've received a bad API payload
     *
     * @param  string $message
     *         details about why the response is bad
     * @param  mixed $badResponse
     *         the payload that we cannot use
     * @return E4xxUnsupportedApiResponse
     */
    public static function newFromBadResponse($message, $badResponse)
    {
        return new static($message . "; data payload is: " . json_encode($badResponse));
    }
}
