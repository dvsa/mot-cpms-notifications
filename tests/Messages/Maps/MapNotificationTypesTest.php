<?php

namespace DVSA\CPMS\Notifications\Messages\Maps;

use DVSA\CPMS\Notifications\Messages\ValueBuilders\BuildMandateNotificationV1FromPayload;
use DVSA\CPMS\Notifications\Messages\ValueBuilders\BuildPaymentNotificationV1FromPayload;
use DVSA\CPMS\Notifications\Messages\ValueBuilders\BuildMessageFromMandateNotificationV1;
use DVSA\CPMS\Notifications\Messages\ValueBuilders\BuildMessageFromPaymentNotificationV1;
use DVSA\CPMS\Notifications\Messages\Values\MandateNotificationV1;
use DVSA\CPMS\Notifications\Messages\Values\PaymentNotificationV1;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass DVSA\CPMS\Notifications\Messages\Maps\MapNotificationTypes
 */
class MapNotificationTypesTest extends TestCase
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

        $obj = new MapNotificationTypes();

        // ----------------------------------------------------------------
        // test the results

        $this->assertInstanceOf(MapNotificationTypes::class, $obj);
    }

    /**
     * @coversNothing
     */
    public function testCanMapMessageToPaymentNotificationV1(): void
    {
        // ----------------------------------------------------------------
        // setup your test

        $expectedResult = new BuildPaymentNotificationV1FromPayload();
        $obj = new MapNotificationTypes();

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $obj->mapMessageTypeToFactory("PAYMENT-NOTIFICATION-v1");

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @coversNothing
     */
    public function testCanMapPaymentNotificationV1ToMessage(): void
    {
        // ----------------------------------------------------------------
        // setup your test

        $obj = new MapNotificationTypes();
        $entity = new PaymentNotificationV1(
            "unit-tests",
            "12345-67890",
            "2015-01-01 00:00:00",
            "none",
            "none",
            "test",
            "confirmed",
            "2015-01-01 00:30:00",
            "TEST-12345-67890",
            0.0,
            "PARENT-98765-4321",
            314
        );
        $expectedResult = new BuildMessageFromPaymentNotificationV1();

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $obj->mapEntityToFactory($entity);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @coversNothing
     */
    public function testCanMapMessageToMandateNotificationV1(): void
    {
        // ----------------------------------------------------------------
        // setup your test

        $expectedResult = new BuildMandateNotificationV1FromPayload();
        $obj = new MapNotificationTypes();

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $obj->mapMessageTypeToFactory('MANDATE-NOTIFICATION-v1');

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @coversNothing
     */
    public function testCanMapMandateNotificationV1ToMessage(): void
    {
        // ----------------------------------------------------------------
        // setup your test

        $obj = new MapNotificationTypes();
        $entity = new MandateNotificationV1(
            'unit-tests',
            '12345-67890',
            '2015-01-01 00:00:00',
            'none',
            'none',
            'test',
            'confirmed',
            '2015-01-01 00:30:00',
            'TEST-12345-67890',
            314
        );
        $expectedResult = new BuildMessageFromMandateNotificationV1();

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $obj->mapEntityToFactory($entity);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }
}
