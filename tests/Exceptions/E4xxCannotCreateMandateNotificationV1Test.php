<?php

namespace DVSA\CPMS\Notifications\Exceptions;

use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 * @coversDefaultClass DVSA\CPMS\Notifications\Exceptions\E4xxCannotCreateMandateNotificationV1
 */
class E4xxCannotCreateMandateNotificationV1Test extends TestCase
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

        $obj = new E4xxCannotCreateMandateNotificationV1($message);

        // ----------------------------------------------------------------
        // test the results

        $this->assertInstanceOf(E4xxCannotCreateMandateNotificationV1::class, $obj);
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

        $obj = new E4xxCannotCreateMandateNotificationV1($message);

        // ----------------------------------------------------------------
        // test the results

        $this->assertInstanceOf(RuntimeException::class, $obj);
    }

    /**
     * @covers ::__construct
     */
    public function testHasErrorCode400()
    {
        // ----------------------------------------------------------------
        // setup your test

        $message = "unknown error";
        $obj = new E4xxCannotCreateMandateNotificationV1($message);

        $expectedCode = 400;

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
        $obj = new E4xxCannotCreateMandateNotificationV1($message);

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

        $cause = new \Exception();

        // ----------------------------------------------------------------
        // perform the change

        $obj = E4xxCannotCreateMandateNotificationV1::newFromException($cause);

        // ----------------------------------------------------------------
        // test the results

        $this->assertInstanceOf(E4xxCannotCreateMandateNotificationV1::class, $obj);
        $this->assertSame($cause, $obj->getPrevious());
    }

    /**
     * @covers ::newFromBadData
     */
    public function testCanGenerateFromBadData()
    {
        // ----------------------------------------------------------------
        // setup your test

        $message = "bad response";
        $badData = [ 'hello, world' ];
        $expectedMessage = "{$message}; data is: " . json_encode($badData);

        // ----------------------------------------------------------------
        // perform the change

        $obj = E4xxCannotCreateMandateNotificationV1::newFromBadData($message, $badData);

        // ----------------------------------------------------------------
        // test the results

        $this->assertInstanceOf(E4xxCannotCreateMandateNotificationV1::class, $obj);
        $this->assertEquals($expectedMessage, $obj->getMessage());
    }
}
