<?php

namespace DVSA\CPMS\Notifications\Exceptions;

use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 * @coversDefaultClass DVSA\CPMS\Notifications\Exceptions\E5xx_CannotGenerateNotificationId
 */
class E5xx_CannotGenerateNotificationIdTest extends TestCase
{
    /**
     * @covers ::__construct
     */
    public function testCanInstantiate()
    {
        // ----------------------------------------------------------------
        // setup your test

        $message = "unknown error";

        // ----------------------------------------------------------------
        // perform the change

        $obj = new E5xx_CannotGenerateNotificationId($message);

        // ----------------------------------------------------------------
        // test the results

        $this->assertInstanceOf(E5xx_CannotGenerateNotificationId::class, $obj);
    }

    /**
     * @covers ::__construct
     */
    public function testIsRuntimeException()
    {
        // ----------------------------------------------------------------
        // setup your test

        $message = "unknown error";

        // ----------------------------------------------------------------
        // perform the change

        $obj = new E5xx_CannotGenerateNotificationId($message);

        // ----------------------------------------------------------------
        // test the results

        $this->assertInstanceOf(RuntimeException::class, $obj);
    }

    /**
     * @covers ::__construct
     */
    public function testHasErrorCode500()
    {
        // ----------------------------------------------------------------
        // setup your test

        $message = "unknown error";
        $obj = new E5xx_CannotGenerateNotificationId($message);

        $expectedCode = 500;

        // ----------------------------------------------------------------
        // perform the change

        $actualCode = $obj->getCode();

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedCode, $actualCode);
    }

    /**
     * @covers ::__construct
     */
    public function testHasErrorMessage()
    {
        // ----------------------------------------------------------------
        // setup your test

        $message = "unknown error";
        $obj = new E5xx_CannotGenerateNotificationId($message);

        $expectedMessage = $message;

        // ----------------------------------------------------------------
        // perform the change

        $actualMessage = $obj->getMessage();

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedMessage, $actualMessage);
    }

    /**
     * @covers ::newFromException
     */
    public function testCanGenerateFromAnotherException()
    {
        // ----------------------------------------------------------------
        // setup your test

        $cause = new \Exception;

        // ----------------------------------------------------------------
        // perform the change

        $obj = E5xx_CannotGenerateNotificationId::newFromException($cause);

        // ----------------------------------------------------------------
        // test the results

        $this->assertInstanceOf(E5xx_CannotGenerateNotificationId::class, $obj);
        $this->assertSame($cause, $obj->getPrevious());
    }

}