<?php

namespace DVSA\CPMS\Notifications\Messages\Constraints;

use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass DVSA\CPMS\Notifications\Messages\Constraints\MandateNotificationV1EventCauses
 */
class MandateNotificationsV1EventCausesTest extends TestCase
{
    /**
     * @covers ::getAllEventCauses
     */
    public function testCanGetListOfValidEventCauses(): void
    {
        // setup of test case
        $expectedResult = [
            'confirmed' => 'confirmed',
            'failed' => 'failed',
            'cancelled' => 'cancelled',
        ];

        // action
        $actualResult = MandateNotificationV1EventCauses::getAllEventCauses();

        // assert
        $this->assertEquals($expectedResult, $actualResult);
    }
}
