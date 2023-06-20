<?php

namespace DVSA\CPMS\Notifications\Exceptions;

use Exception;
use RuntimeException;

/**
 * exception thrown when we cannot factory to convert notification data
 * into a value object
 *
 * this is normally caused by receiving bad data
 */
class E4xx_NoFactoryForApiResponse extends RuntimeException
{
    /**
     * constructor
     *
     * @param string $message
     *        information about the factory that we cannot find
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
     * @return E4xx_NoFactoryForApiResponse
     */
    public static function newFromException(Exception $cause)
    {
        return new static($cause->getMessage(), $cause);
    }
}