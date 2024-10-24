<?php

namespace DVSA\CPMS\Notifications\Messages\ValueBuilders;

use DVSA\CPMS\Notifications\Exceptions\E4xxCannotCreateMandateNotificationV1;
use DVSA\CPMS\Notifications\Messages\Values\MandateNotificationV1;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * @coversDefaultClass DVSA\CPMS\Notifications\Messages\ValueBuilders\BuildMandateNotificationV1FromPayload
 */
class BuildMandateNotificationV1FromMessageTest extends TestCase
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

        $obj = new BuildMandateNotificationV1FromPayload();

        // ----------------------------------------------------------------
        // test the results

        $this->assertInstanceOf(BuildMandateNotificationV1FromPayload::class, $obj);
    }

    /**
     * @covers ::__invoke
     * @covers ::from
     */
    public function testCanBuildEntity(): void
    {
        // ----------------------------------------------------------------
        // setup your test

        $payload = (object)[
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
        ];
        $expectedResult = new MandateNotificationV1(
            "unit-tests",
            "12345-67890",
            "2015-01-01 00:00:00",
            "unit-test",
            "test-scope",
            "test",
            'confirmed',
            "2015-01-01 00:30:00",
            "TEST-12345-67890",
            314
        );
        $obj = new BuildMandateNotificationV1FromPayload();

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
     * @dataProvider provideNonObjectPayloadsToTest
     */
    public function testThrowsExceptionIfPayloadIsNotAnObject(mixed $payload): void
    {
        // ----------------------------------------------------------------
        // setup your test

        $this->expectException(E4xxCannotCreateMandateNotificationV1::class);

        $obj = new BuildMandateNotificationV1FromPayload();

        // ----------------------------------------------------------------
        // perform the change

        // @phpstan-ignore argument.type
        $obj($payload);

        // ----------------------------------------------------------------
        // test the results
    }

    /**
     * @covers ::__invoke
     * @covers ::from
     * @dataProvider providePartialMandateDataToTest
     */
    public function testThrowsExceptionIfRequiredFieldMissing(stdClass $payload): void
    {
        // ----------------------------------------------------------------
        // setup your test

        $this->expectException(E4xxCannotCreateMandateNotificationV1::class);

        $obj = new BuildMandateNotificationV1FromPayload();

        // ----------------------------------------------------------------
        // perform the change

        $obj($payload);

        // ----------------------------------------------------------------
        // test the results
    }

    public function provideNonObjectPayloadsToTest(): array
    {
        return [
            [ null ],
            [ [] ],
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

    public function providePartialMandateDataToTest(): array
    {
        $complete_payload = (object)[
            'origin' => 'unit-tests',
            'notificationId' => '12345-67890',
            'acknowledgeBy' => '2015-01-01 00:00:00.000000 +0000',
            'scheme' => 'unit-test',
            'scope' => 'test-scope',
            'eventType' => 'test',
            'eventCause' => 'confirmed',
            'eventDate' => '2015-01-01 00:30:00.000000 +0000',
            'mandateReference' => 'TEST-12345-67890',
            'entityVersion' => 314,
        ];

        $retval = [];
        $fields = get_object_vars($complete_payload);

        foreach ($fields as $field => $value) {
            $payload = clone $complete_payload;
            unset($payload->{$field});
            $retval[] = [ $payload ];
        }

        return $retval;
    }
}
