<?php

namespace DVSA\CPMS\Notifications\Messages\ValueBuilders;

use DVSA\CPMS\Notifications\Exceptions\E4xxNoFactoryForApiResponse;
use DVSA\CPMS\Notifications\Exceptions\E4xxUnsupportedApiResponse;
use DVSA\CPMS\Notifications\Messages\Values\MandateNotificationV1;
use DVSA\CPMS\Notifications\Messages\Values\PaymentNotificationV1;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass DVSA\CPMS\Notifications\Messages\ValueBuilders\BuildNotificationFromApiResponse
 */
class BuildNotificationFromApiResponseTest extends TestCase
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

        $unit = new BuildNotificationFromApiResponse();

        // ----------------------------------------------------------------
        // test the results

        $this->assertInstanceOf(BuildNotificationFromApiResponse::class, $unit);
    }

    /**
     * @covers ::__invoke
     * @covers ::from
     * @dataProvider provideExampleApiResponses
     */
    public function testCanBuildEntity(array $apiResponse, MandateNotificationV1|PaymentNotificationV1 $expectedResult): void
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new BuildNotificationFromApiResponse();

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $unit($apiResponse);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::from
     * @dataProvider provideNonArray
     */
    public function testThrowsExceptionWhenGivenNonArrayAsApiResponse(mixed $apiResponse): void
    {
        // ----------------------------------------------------------------
        // setup your test

        $this->expectException(E4xxUnsupportedApiResponse::class);

        $unit = new BuildNotificationFromApiResponse();

        // ----------------------------------------------------------------
        // perform the change

        // @phpstan-ignore argument.type
        $unit($apiResponse);

        // ----------------------------------------------------------------
        // test the results
    }

    /**
     * @covers ::from
     */
    public function testThrowsExceptionWhenApiResponseHasNoNotificationTypeField(): void
    {
        // ----------------------------------------------------------------
        // setup your test

        $this->expectException(E4xxUnsupportedApiResponse::class);

        $unit = new BuildNotificationFromApiResponse();

        // ----------------------------------------------------------------
        // perform the change

        $unit([]);

        // ----------------------------------------------------------------
        // test the results
    }

    /**
     * @covers ::from
     */
    public function testThrowsExceptionWhenApiResponseHasUnsupportedNotificationTypeField(): void
    {
        // ----------------------------------------------------------------
        // setup your test

        $this->expectException(E4xxNoFactoryForApiResponse::class);

        $unit = new BuildNotificationFromApiResponse();

        // ----------------------------------------------------------------
        // perform the change

        $unit(['notification_type' => 'NotARealNotification']);

        // ----------------------------------------------------------------
        // test the results
    }

    public function provideExampleApiResponses(): array
    {
        return [
            [
                [
                    'origin' => 'unit-tests',
                    'notification_type' => 'MandateNotificationV1',
                    'notification_id' => '12345-67890',
                    'acknowledge_due' => '2015-01-01 00:00:00.000000 +0000',
                    'scheme' => 'unit-test',
                    'scope' => 'test-scope',
                    'event_type' => 'test',
                    'event_cause' => 'confirmed',
                    'event_date' => '2015-01-01 00:30:00.000000 +0000',
                    'mandate_reference' => 'TEST-12345-67890',
                    'entity_version' => 314,
                ],
                new MandateNotificationV1(
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
                )
            ],
            [
                [
                    'origin' => 'unit-tests',
                    'notification_type' => 'PaymentNotificationV1',
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
                    'entity_version' => 314
                ],
                new PaymentNotificationV1(
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
                )
            ],
        ];
    }

    public function provideNonArray(): array
    {
        return [
            [ null ],
            [ true ],
            [ false ],
            [ function () {
                return [];
            } ],
            [ 0.0 ],
            [ 3.1415927 ],
            [ 0 ],
            [ 100 ],
            [ STDIN ],
            [ (object)[] ],
            [ "hello, world" ],
        ];
    }
}
