<?php

namespace DVSA\CPMS\Notifications\Messages\Constraints;

use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass DVSA\CPMS\Notifications\Messages\Constraints\PaymentNotificationV1EventTypes
 */
class PaymentNotificationV1EventTypesTest extends TestCase
{
    /**
     * @covers ::getAllEventTypes
     */
    public function testCanGetListOfValidEventTypes(): void
    {
        // ----------------------------------------------------------------
        // setup your test

        $expectedResult = [
            'complete' => 'complete',
            'fail' => 'fail'
        ];

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = PaymentNotificationV1EventTypes::getAllEventTypes();

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }
}
