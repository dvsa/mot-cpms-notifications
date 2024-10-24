<?php

namespace DVSA\CPMS\Notifications\Messages\ValueBuilders;

use DVSA\CPMS\Notifications\Messages\Values\PaymentNotificationV1;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass DVSA\CPMS\Notifications\Messages\ValueBuilders\BuildMessageFromPaymentNotificationV1
 */
class BuildMessageFromPaymentNotificationV1Test extends TestCase
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

        $obj = new BuildMessageFromPaymentNotificationV1();

        // ----------------------------------------------------------------
        // test the results

        $this->assertInstanceOf(BuildMessageFromPaymentNotificationV1::class, $obj);
    }

    /**
     * @covers ::__invoke
     * @covers ::from
     */
    public function testCanBuildMultipartMessage(): void
    {
        // ----------------------------------------------------------------
        // setup your test

        $entity = new PaymentNotificationV1(
            "unit-tests",
            "12345-67890",
            "2015-01-01 00:00:00",
            "unit-test",
            "test-scope",
            "test",
            "confirmed",
            "2015-01-01 00:30:00",
            "TEST-12345-67890",
            0.0,
            "PARENT-98765-4321",
            314
        );
        $expectedResult = "PAYMENT-NOTIFICATION-v1\n" . json_encode([
            'origin' => 'unit-tests',
            'notification_id' => '12345-67890',
            'acknowledge_by' => '2015-01-01 00:00:00.000000 +0000',
            'scheme' => 'unit-test',
            'scope' => 'test-scope',
            'event_type' => 'test',
            'event_cause' => 'confirmed',
            'event_date' => '2015-01-01 00:30:00.000000 +0000',
            'receipt_reference' => 'TEST-12345-67890',
            'amount' => 0.0,
            'parent_reference' => "PARENT-98765-4321",
            'entity_version' => 314,
        ]);
        $obj = new BuildMessageFromPaymentNotificationV1();

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $obj($entity);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }
}
