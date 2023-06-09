<?php

namespace DVSA\CPMS\Notifications\Messages\Constraints;

use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass DVSA\CPMS\Notifications\Messages\Constraints\MandateNotificationV1EventTypes
 */
class MandateNotificationV1EventTypesTest extends TestCase
{
    /**
     * @covers ::getAllEventTypes
     */
    public function testCanGetListOfValidEventTypes()
    {
        // ----------------------------------------------------------------
        // setup your test

        $expectedResult = [
            'active' => 'active',
            'cancelled' => 'cancelled'
        ];

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = MandateNotificationV1EventTypes::getAllEventTypes();

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

}
