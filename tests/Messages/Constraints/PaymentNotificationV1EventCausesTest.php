<?php

namespace DVSA\CPMS\Notifications\Messages\Constraints;

use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass DVSA\CPMS\Notifications\Messages\Constraints\PaymentNotificationV1EventCauses
 */
class PaymentNotificationV1EventCausesTest extends TestCase
{

    /**
     * @covers ::getAllEventCauses
     */
    public function testCanGetListOfValidEventCauses()
    {
        // setup of test case
        $expectedResult = [
            'confirmed' => 'confirmed',
            'failed' => 'failed',
            'cancelled' => 'cancelled',
        ];

        // action
        $actualResult = PaymentNotificationV1EventCauses::getAllEventCauses();

        // assert
        $this->assertEquals($expectedResult, $actualResult);
    }
}
