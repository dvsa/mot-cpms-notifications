<?php

namespace DVSA\CPMS\Notifications\Messages\ValueBuilders;

use DVSA\CPMS\Notifications\Messages\Values\MandateNotificationV1;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass DVSA\CPMS\Notifications\Messages\ValueBuilders\BuildMessageFromMandateNotificationV1
 */
class BuildMessageFromMandateNotificationV1Test extends TestCase
{
    /**
     * @coversNothing
     */
    public function testCanInstantiate(): void
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $obj = new BuildMessageFromMandateNotificationV1();

        // ----------------------------------------------------------------
        // test the results

        $this->assertInstanceOf(BuildMessageFromMandateNotificationV1::class, $obj);
    }

    /**
     * @covers ::__invoke
     * @covers ::from
     */
    public function testCanBuildMultipartMessage(): void
    {
        // ----------------------------------------------------------------
        // setup your test

        $entity = new MandateNotificationV1(
            "unit-tests",
            "12345-67890",
            "2015-01-01 00:00:00",
            "unit-test",
            "test-scope",
            "test",
            "confirmed",
            "2015-01-01 00:30:00",
            "TEST-12345-67890",
            314
        );
        $expectedResult = "MANDATE-NOTIFICATION-v1\n" . json_encode([
                'origin' => 'unit-tests',
                'notification_id' => '12345-67890',
                'acknowledge_by' => '2015-01-01 00:00:00.000000 +0000',
                'scheme' => 'unit-test',
                'scope' => 'test-scope',
                'event_type' => 'test',
                'event_cause' => 'confirmed',
                'event_date' => '2015-01-01 00:30:00.000000 +0000',
                'mandate_reference' => 'TEST-12345-67890',
                'entity_version' => 314,
            ]);
        $obj = new BuildMessageFromMandateNotificationV1();

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $obj($entity);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }
}
