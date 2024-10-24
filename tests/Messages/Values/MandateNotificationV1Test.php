<?php

namespace DVSA\CPMS\Notifications\Messages\Values;

use DateTime;
use DVSA\CPMS\Notifications\Exceptions\E4xxCannotCreateMandateNotificationV1;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * @coversDefaultClass DVSA\CPMS\Notifications\Messages\Values\MandateNotificationV1
 */
class MandateNotificationV1Test extends TestCase
{
    /**
     * @covers ::__construct
     * @dataProvider provideExampleNotifications
     */
    public function testCanInstantiate($payload, $expectedResult)
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $ref = new ReflectionClass(MandateNotificationV1::class);
        $actualResult = $ref->newInstanceArgs($payload);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::__construct
     * @covers ::ensureDateTime
     */
    public function testAcknowledgeByDateCanBeStringContainingValidDateTime()
    {
        // ----------------------------------------------------------------
        // setup your test

        $payload = [
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

        // ----------------------------------------------------------------
        // perform the change

        $ref = new ReflectionClass(MandateNotificationV1::class);
        $unit = $ref->newInstanceArgs($payload);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals(new DateTime($payload['acknowledgeBy']), $unit->getAcknowledgeBy());
    }

    /**
     * @covers ::__construct
     * @covers ::ensureDateTime
     */
    public function testAcknowledgeByDateCanBeDateTime()
    {
        // ----------------------------------------------------------------
        // setup your test

        $payload = [
            'origin' => 'unit-tests',
            'notificationId' => '12345-67890',
            'acknowledgeBy' => new DateTime('2015-01-01 00:00:00.000000 +0000'),
            'scheme' => 'unit-test',
            'scope' => 'test-scope',
            'eventType' => 'test',
            'eventCause' => 'confirmed',
            'eventDate' => '2015-01-01 00:30:00.000000 +0000',
            'mandateReference' => 'TEST-12345-67890',
            'entityVersion' => 314,
        ];

        // ----------------------------------------------------------------
        // perform the change

        $ref = new ReflectionClass(MandateNotificationV1::class);
        $unit = $ref->newInstanceArgs($payload);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($payload['acknowledgeBy'], $unit->getAcknowledgeBy());
    }

    /**
     * @covers ::__construct
     * @covers ::ensureDateTime
     * @dataProvider provideNonDateTimes
     */
    public function testAcknowledgeByDateCannotBeAnythingElse($nonDateTime)
    {
        // ----------------------------------------------------------------
        // setup your test

        $this->expectException(E4xxCannotCreateMandateNotificationV1::class);

        $payload = [
            'origin' => 'unit-tests',
            'notificationId' => '12345-67890',
            'acknowledgeBy' => $nonDateTime,
            'scheme' => 'unit-test',
            'scope' => 'test-scope',
            'eventType' => 'test',
            'eventCause' => 'confirmed',
            'eventDate' => '2015-01-01 00:30:00.000000 +0000',
            'mandateReference' => 'TEST-12345-67890',
            'entityVersion' => 314,
        ];

        // ----------------------------------------------------------------
        // perform the change

        $ref = new ReflectionClass(MandateNotificationV1::class);
        $unit = $ref->newInstanceArgs($payload);

        // ----------------------------------------------------------------
        // test the results
    }

    /**
     * @covers ::__construct
     * @covers ::ensureDateTime
     */
    public function testEventDateCanBeStringContainingValidDateTime()
    {
        // ----------------------------------------------------------------
        // setup your test

        $payload = [
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

        // ----------------------------------------------------------------
        // perform the change

        $ref = new ReflectionClass(MandateNotificationV1::class);
        $unit = $ref->newInstanceArgs($payload);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals(new DateTime($payload['eventDate']), $unit->getEventDate());
    }

    /**
     * @covers ::__construct
     * @covers ::ensureDateTime
     */
    public function testEventDateCanBeDateTime()
    {
        // ----------------------------------------------------------------
        // setup your test

        $payload = [
            'origin' => 'unit-tests',
            'notificationId' => '12345-67890',
            'acknowledgeBy' => '2015-01-01 00:00:00.000000 +0000',
            'scheme' => 'unit-test',
            'scope' => 'test-scope',
            'eventType' => 'test',
            'eventCause' => 'confirmed',
            'eventDate' => new DateTime('2015-01-01 00:30:00.000000 +0000'),
            'mandateReference' => 'TEST-12345-67890',
            'entityVersion' => 314,
        ];

        // ----------------------------------------------------------------
        // perform the change

        $ref = new ReflectionClass(MandateNotificationV1::class);
        $unit = $ref->newInstanceArgs($payload);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($payload['eventDate'], $unit->getEventDate());
    }

    /**
     * @covers ::__construct
     * @covers ::ensureDateTime
     * @dataProvider provideNonDateTimes
     */
    public function testEventDateCannotBeAnythingElse($nonDateTime)
    {
        // ----------------------------------------------------------------
        // setup your test

        $this->expectException(E4xxCannotCreateMandateNotificationV1::class);

        $payload = [
            'origin' => 'unit-tests',
            'notificationId' => '12345-67890',
            'acknowledgeBy' => '2015-01-01 00:00:00.000000 +0000',
            'scheme' => 'unit-test',
            'scope' => 'test-scope',
            'eventType' => 'test',
            'eventCause' => 'confirmed',
            'eventDate' => $nonDateTime,
            'mandateReference' => 'TEST-12345-67890',
            'entityVersion' => 314,
        ];

        // ----------------------------------------------------------------
        // perform the change

        $ref = new ReflectionClass(MandateNotificationV1::class);
        $unit = $ref->newInstanceArgs($payload);

        // ----------------------------------------------------------------
        // test the results
    }

    /**
     * @covers ::getOrigin
     * @dataProvider provideExampleNotifications
     */
    public function testCanGetNotificationOrigin($payload)
    {
        // ----------------------------------------------------------------
        // setup your test

        $ref = new ReflectionClass(MandateNotificationV1::class);
        $unit = $ref->newInstanceArgs($payload);
        $expectedResult = $payload['origin'];

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $unit->getOrigin();

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::getNotificationId
     * @dataProvider provideExampleNotifications
     */
    public function testCanGetNotificationId($payload)
    {
        // ----------------------------------------------------------------
        // setup your test

        $ref = new ReflectionClass(MandateNotificationV1::class);
        $unit = $ref->newInstanceArgs($payload);
        $expectedResult = $payload['notificationId'];

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $unit->getNotificationId();

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::getAcknowledgeBy
     * @dataProvider provideExampleNotifications
     */
    public function testCanGetAcknowledgeByDate($payload)
    {
        // ----------------------------------------------------------------
        // setup your test

        $ref = new ReflectionClass(MandateNotificationV1::class);
        $unit = $ref->newInstanceArgs($payload);
        $expectedResult = new DateTime($payload['acknowledgeBy']);

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $unit->getAcknowledgeBy();

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::getScheme
     * @dataProvider provideExampleNotifications
     */
    public function testCanGetIntendedScheme($payload)
    {
        // ----------------------------------------------------------------
        // setup your test

        $ref = new ReflectionClass(MandateNotificationV1::class);
        $unit = $ref->newInstanceArgs($payload);
        $expectedResult = $payload['scheme'];

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $unit->getScheme();

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::getScope
     * @dataProvider provideExampleNotifications
     */
    public function testCanGetPaymentScope($payload)
    {
        // ----------------------------------------------------------------
        // setup your test

        $ref = new ReflectionClass(MandateNotificationV1::class);
        $unit = $ref->newInstanceArgs($payload);
        $expectedResult = $payload['scope'];

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $unit->getScope();

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::getEventType
     * @dataProvider provideExampleNotifications
     */
    public function testCanGetEventType($payload)
    {
        // ----------------------------------------------------------------
        // setup your test

        $ref = new ReflectionClass(MandateNotificationV1::class);
        $unit = $ref->newInstanceArgs($payload);
        $expectedResult = $payload['eventType'];

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $unit->getEventType();

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::getEventCause
     * @dataProvider provideExampleNotifications
     */
    public function testCanGetEventCause($payload)
    {
        // ----------------------------------------------------------------
        // setup your test

        $ref = new ReflectionClass(MandateNotificationV1::class);
        $unit = $ref->newInstanceArgs($payload);
        $expectedResult = $payload['eventCause'];

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $unit->getEventCause();

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::getEventDate
     * @dataProvider provideExampleNotifications
     */
    public function testCanGetEventDate($payload)
    {
        // ----------------------------------------------------------------
        // setup your test

        $ref = new ReflectionClass(MandateNotificationV1::class);
        $unit = $ref->newInstanceArgs($payload);
        $expectedResult = new DateTime($payload['eventDate']);

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $unit->getEventDate();

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::getMandateReference
     * @dataProvider provideExampleNotifications
     */
    public function testCanGetMandateReference($payload)
    {
        // ----------------------------------------------------------------
        // setup your test

        $ref = new ReflectionClass(MandateNotificationV1::class);
        $unit = $ref->newInstanceArgs($payload);
        $expectedResult = $payload['mandateReference'];

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $unit->getMandateReference();

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::getEntityVersion
     * @dataProvider provideExampleNotifications
     */
    public function testCanGetEntityVersion($payload)
    {
        // ----------------------------------------------------------------
        // setup your test

        $ref = new ReflectionClass(MandateNotificationV1::class);
        $unit = $ref->newInstanceArgs($payload);
        $expectedResult = $payload['entityVersion'];

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $unit->getEntityVersion();

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    public function provideExampleNotifications()
    {
        return [
            [
                [
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
        ];
    }

    public function provideNonDateTimes()
    {
        return [
            [ null ],
            [ [] ],
            [ true ],
            [ false ],
            [ function () {
            } ],
            [ 0.0 ],
            [ 3.1415927 ],
            [ 0 ],
            [ 100 ],
            [ STDIN ],
            [ (object)[ '2015-03-05 02:04:06.567899 +0000'] ],
            [ "hello, world" ],
        ];
    }
}
