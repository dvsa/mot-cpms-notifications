<?php

namespace DVSA\CPMS\Notifications\Exceptions;

use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 * @coversDefaultClass DVSA\CPMS\Notifications\Exceptions\E4xxUnsupportedApiResponse
 */
class E4xxUnsupportedApiResponseTest extends TestCase
{
    /**
     * @covers ::__construct
     */
    public function testCanInstantiate(): void
    {
        // ----------------------------------------------------------------
        // setup your test

        $message = "unknown error";

        // ----------------------------------------------------------------
        // perform the change

        $obj = new E4xxUnsupportedApiResponse($message);

        // ----------------------------------------------------------------
        // test the results

        $this->assertInstanceOf(E4xxUnsupportedApiResponse::class, $obj);
    }

    /**
     * @covers ::__construct
     */
    public function testIsRuntimeException(): void
    {
        // ----------------------------------------------------------------
        // setup your test

        $message = "unknown error";

        // ----------------------------------------------------------------
        // perform the change

        $obj = new E4xxUnsupportedApiResponse($message);

        // ----------------------------------------------------------------
        // test the results

        $this->assertInstanceOf(RuntimeException::class, $obj);
    }

    /**
     * @covers ::__construct
     */
    public function testHasErrorCode400(): void
    {
        // ----------------------------------------------------------------
        // setup your test

        $message = "unknown error";
        $obj = new E4xxUnsupportedApiResponse($message);

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
    public function testHasErrorMessage(): void
    {
        // ----------------------------------------------------------------
        // setup your test

        $message = "unknown error";
        $obj = new E4xxUnsupportedApiResponse($message);

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
    public function testCanGenerateFromAnotherException(): void
    {
        // ----------------------------------------------------------------
        // setup your test

        $cause = new \Exception();

        // ----------------------------------------------------------------
        // perform the change

        $obj = E4xxUnsupportedApiResponse::newFromException($cause);

        // ----------------------------------------------------------------
        // test the results

        $this->assertInstanceOf(E4xxUnsupportedApiResponse::class, $obj);
        $this->assertSame($cause, $obj->getPrevious());
    }

    /**
     * @covers ::newFromBadResponse
     */
    public function testCanGenerateFromBadResponse(): void
    {
        // ----------------------------------------------------------------
        // setup your test

        $message = "bad response";
        $badData = [ 'hello, world' ];
        $expectedMessage = "{$message}; data payload is: " . json_encode($badData);

        // ----------------------------------------------------------------
        // perform the change

        $obj = E4xxUnsupportedApiResponse::newFromBadResponse($message, $badData);

        // ----------------------------------------------------------------
        // test the results

        $this->assertInstanceOf(E4xxUnsupportedApiResponse::class, $obj);
        $this->assertEquals($expectedMessage, $obj->getMessage());
    }
}
