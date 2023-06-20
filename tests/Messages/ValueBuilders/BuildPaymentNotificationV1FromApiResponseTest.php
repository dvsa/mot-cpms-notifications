<?php

namespace DVSA\CPMS\Notifications\Messages\ValueBuilders;

use DVSA\CPMS\Notifications\Exceptions\E4xx_CannotCreatePaymentNotificationV1;
use DVSA\CPMS\Notifications\Messages\Values\PaymentNotificationV1;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass DVSA\CPMS\Notifications\Messages\ValueBuilders\BuildPaymentNotificationV1FromApiResponse
 */
class BuildPaymentNotificationV1FromApiResponseTest extends TestCase
{
    /**
     * @coversNothing
     */
    public function testCanInstantiate()
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $obj = new BuildPaymentNotificationV1FromApiResponse;

        // ----------------------------------------------------------------
        // test the results

        $this->assertInstanceOf(BuildPaymentNotificationV1FromApiResponse::class, $obj);
    }

    /**
     * @covers ::__invoke
     * @covers ::from
     */
    public function testCanBuildEntity()
    {
        // ----------------------------------------------------------------
        // setup your test

        $payload = [
            'origin' => 'unit-tests',
            'notification_id' => '12345-67890',
            'acknowledge_due' => '2015-01-01 00:00:00.000000 +0000',
            'scheme' => 'unit-test',
            'scope' => 'test-scope',
            'event_type' => 'test',
            'event_cause' => 'confirmed',
            'event_date' => '2015-01-01 00:30:00.000000 +0000',
            'receipt_reference' => 'TEST-12345-67890',
            'amount' => 0.0,
            'parent_reference' => "PARENT-98765-4321",
            'entity_version' => 314,
        ];
        $expectedResult = new PaymentNotificationV1(
            "unit-tests",
            "12345-67890",
            "2015-01-01 00:00:00",
            "unit-test",
            "test-scope",
            "test",
            'confirmed',
            "2015-01-01 00:30:00",
            "TEST-12345-67890",
            0.0,
            "PARENT-98765-4321",
            314
        );
        $obj = new BuildPaymentNotificationV1FromApiResponse;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $obj($payload);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::__invoke
     * @covers ::from
     * @dataProvider provideNonArrayPayloadsToTest
     */
    public function testThrowsExceptionIfPayloadIsNotAnArray($payload)
    {
        // ----------------------------------------------------------------
        // setup your test

        $this->expectException(E4xx_CannotCreatePaymentNotificationV1::class);

        $obj = new BuildPaymentNotificationV1FromApiResponse;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $obj($payload);

        // ----------------------------------------------------------------
        // test the results
    }

    /**
     * @covers ::__invoke
     * @covers ::from
     * @dataProvider providePartialMandateDataToTest
     */
    public function testThrowsExceptionIfRequiredFieldMissing($payload)
    {
        // ----------------------------------------------------------------
        // setup your test

        $this->expectException(E4xx_CannotCreatePaymentNotificationV1::class);

        $obj = new BuildPaymentNotificationV1FromApiResponse;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $obj($payload);

        // ----------------------------------------------------------------
        // test the results
    }

    public function provideNonArrayPayloadsToTest()
    {
        return [
            [ null ],
            [ true ],
            [ false ],
            [ 0.0 ],
            [ 100 ],
            [ 0 ],
            [ 3.1415927 ],
            [ STDIN ],
            [ "hello, world" ],
        ];
    }

    public function providePartialMandateDataToTest()
    {
        $complete_payload = [
            'origin' => 'unit-tests',
            'notificationId' => '12345-67890',
            'acknowledgeBy' => '2015-01-01 00:00:00.000000 +0000',
            'scheme' => 'unit-test',
            'scope' => 'test-scope',
            'eventType' => 'test',
            'eventCause' => 'confirmed',
            'eventDate' => '2015-01-01 00:30:00.000000 +0000',
            'receipt_reference' => 'TEST-12345-67890',
            'amount' => 0.0,
            'parent_reference' => "PARENT-98765-4321",
            'entityVersion' => 314
        ];

        $retval = [];

        foreach ($complete_payload as $field => $value) {
            $payload = $complete_payload;
            unset($payload->{$field});
            $retval[] = [ $payload ];
        }

        return $retval;
    }
}