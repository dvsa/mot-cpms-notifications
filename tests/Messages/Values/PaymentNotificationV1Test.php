<?php

namespace DVSA\CPMS\Notifications\Messages\Values;

use DateTime;
use DVSA\CPMS\Notifications\Exceptions\E4xxCannotCreatePaymentNotificationV1;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * @coversDefaultClass DVSA\CPMS\Notifications\Messages\Values\PaymentNotificationV1
 */
class PaymentNotificationV1Test extends TestCase
{
    /**
     * @covers ::__construct
     * @dataProvider provideExampleNotifications
     */
    public function testCanInstantiate(array $payload, PaymentNotificationV1 $expectedResult): void
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $ref = new ReflectionClass(PaymentNotificationV1::class);
        $actualResult = $ref->newInstanceArgs($payload);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::__construct
     * @covers ::ensureDateTime
     */
    public function testAcknowledgeByDateCanBeStringContainingValidDateTime(): void
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
            'receiptReference' => 'TEST-12345-67890',
            'amount' => 0.0,
            'parentReference' => "PARENT-98765-4321",
            'entityVersion' => 314,
        ];

        // ----------------------------------------------------------------
        // perform the change

        $ref = new ReflectionClass(PaymentNotificationV1::class);
        $unit = $ref->newInstanceArgs($payload);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals(new DateTime($payload['acknowledgeBy']), $unit->getAcknowledgeBy());
    }

    /**
     * @covers ::__construct
     * @covers ::ensureDateTime
     */
    public function testAcknowledgeByDateCanBeDateTime(): void
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
            'receiptReference' => 'TEST-12345-67890',
            'amount' => 0.0,
            'parentReference' => "PARENT-98765-4321",
            'entityVersion' => 314,
        ];

        // ----------------------------------------------------------------
        // perform the change

        $ref = new ReflectionClass(PaymentNotificationV1::class);
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
    public function testAcknowledgeByDateCannotBeAnythingElse(mixed $nonDateTime): void
    {
        // ----------------------------------------------------------------
        // setup your test

        $this->expectException(E4xxCannotCreatePaymentNotificationV1::class);

        $payload = [
            'origin' => 'unit-tests',
            'notificationId' => '12345-67890',
            'acknowledgeBy' => $nonDateTime,
            'scheme' => 'unit-test',
            'scope' => 'test-scope',
            'eventType' => 'test',
            'eventCause' => 'confirmed',
            'eventDate' => '2015-01-01 00:30:00.000000 +0000',
            'receiptReference' => 'TEST-12345-67890',
            'amount' => 0.0,
            'parentReference' => "PARENT-98765-4321",
            'entityVersion' => 314,
        ];

        // ----------------------------------------------------------------
        // perform the change

        $ref = new ReflectionClass(PaymentNotificationV1::class);
        $unit = $ref->newInstanceArgs($payload);

        // ----------------------------------------------------------------
        // test the results
    }

    /**
     * @covers ::__construct
     * @covers ::ensureDateTime
     */
    public function testEventDateCanBeStringContainingValidDateTime(): void
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
            'receiptReference' => 'TEST-12345-67890',
            'amount' => 0.0,
            'parentReference' => "PARENT-98765-4321",
            'entityVersion' => 314,
        ];

        // ----------------------------------------------------------------
        // perform the change

        $ref = new ReflectionClass(PaymentNotificationV1::class);
        $unit = $ref->newInstanceArgs($payload);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals(new DateTime($payload['eventDate']), $unit->getEventDate());
    }

    /**
     * @covers ::__construct
     * @covers ::ensureDateTime
     */
    public function testEventDateCanBeDateTime(): void
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
            'receiptReference' => 'TEST-12345-67890',
            'amount' => 0.0,
            'parentReference' => "PARENT-98765-4321",
            'entityVersion' => 314,
        ];

        // ----------------------------------------------------------------
        // perform the change

        $ref = new ReflectionClass(PaymentNotificationV1::class);
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
    public function testEventDateCannotBeAnythingElse(mixed $nonDateTime): void
    {
        // ----------------------------------------------------------------
        // setup your test

        $this->expectException(E4xxCannotCreatePaymentNotificationV1::class);

        $payload = [
            'origin' => 'unit-tests',
            'notificationId' => '12345-67890',
            'acknowledgeBy' => '2015-01-01 00:00:00.000000 +0000',
            'scheme' => 'unit-test',
            'scope' => 'test-scope',
            'eventType' => 'test',
            'eventCause' => 'confirmed',
            'eventDate' => $nonDateTime,
            'receiptReference' => 'TEST-12345-67890',
            'amount' => 0.0,
            'parentReference' => "PARENT-98765-4321",
            'entityVersion' => 314,
        ];

        // ----------------------------------------------------------------
        // perform the change

        $ref = new ReflectionClass(PaymentNotificationV1::class);
        $unit = $ref->newInstanceArgs($payload);

        // ----------------------------------------------------------------
        // test the results
    }

    /**
     * @covers ::__construct
     */
    public function testParentReferenceCanBeNull(): void
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
            'receiptReference' => 'TEST-12345-67890',
            'amount' => 0.0,
        ];

        // ----------------------------------------------------------------
        // perform the change

        $ref = new ReflectionClass(PaymentNotificationV1::class);
        $unit = $ref->newInstanceArgs($payload);

        // ----------------------------------------------------------------
        // test the results

        $this->assertInstanceOf(PaymentNotificationV1::class, $unit);
        $this->assertNull($unit->getParentReference());
    }

    /**
     * @covers ::__construct
     */
    public function testEntityVersionCanBeNull(): void
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
            'receiptReference' => 'TEST-12345-67890',
            'amount' => 0.0,
            'parentReference' => 'TEST-23456-78901',
        ];

        // ----------------------------------------------------------------
        // perform the change

        $ref = new ReflectionClass(PaymentNotificationV1::class);
        $unit = $ref->newInstanceArgs($payload);

        // ----------------------------------------------------------------
        // test the results

        $this->assertInstanceOf(PaymentNotificationV1::class, $unit);
        $this->assertNull($unit->getEntityVersion());
    }

    /**
     * @covers ::getOrigin
     * @dataProvider provideExampleNotifications
     */
    public function testCanGetNotificationOrigin(array $payload): void
    {
        // ----------------------------------------------------------------
        // setup your test

        $ref = new ReflectionClass(PaymentNotificationV1::class);
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
    public function testCanGetNotificationId(array $payload): void
    {
        // ----------------------------------------------------------------
        // setup your test

        $ref = new ReflectionClass(PaymentNotificationV1::class);
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
    public function testCanGetAcknowledgeByDate(array $payload): void
    {
        // ----------------------------------------------------------------
        // setup your test

        $ref = new ReflectionClass(PaymentNotificationV1::class);
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
    public function testCanGetIntendedScheme(array $payload): void
    {
        // ----------------------------------------------------------------
        // setup your test

        $ref = new ReflectionClass(PaymentNotificationV1::class);
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
    public function testCanGetPaymentScope(array $payload): void
    {
        // ----------------------------------------------------------------
        // setup your test

        $ref = new ReflectionClass(PaymentNotificationV1::class);
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
    public function testCanGetEventType(array $payload): void
    {
        // ----------------------------------------------------------------
        // setup your test

        $ref = new ReflectionClass(PaymentNotificationV1::class);
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
    public function testCanGetEventCause(array $payload): void
    {
        // ----------------------------------------------------------------
        // setup your test

        $ref = new ReflectionClass(PaymentNotificationV1::class);
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
    public function testCanGetEventDate(array $payload): void
    {
        // ----------------------------------------------------------------
        // setup your test

        $ref = new ReflectionClass(PaymentNotificationV1::class);
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
     * @covers ::getReceiptReference
     * @dataProvider provideExampleNotifications
     */
    public function testCanGetReceiptReference(array $payload): void
    {
        // ----------------------------------------------------------------
        // setup your test

        $ref = new ReflectionClass(PaymentNotificationV1::class);
        $unit = $ref->newInstanceArgs($payload);
        $expectedResult = $payload['receiptReference'];

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $unit->getReceiptReference();

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::getAmount
     * @dataProvider provideExampleNotifications
     */
    public function testCanGetAmount(array $payload): void
    {
        // ----------------------------------------------------------------
        // setup your test

        $ref = new ReflectionClass(PaymentNotificationV1::class);
        $unit = $ref->newInstanceArgs($payload);
        $expectedResult = $payload['amount'];

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $unit->getAmount();

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::getParentReference
     * @dataProvider provideExampleNotifications
     */
    public function testCanGetParentReference(array $payload): void
    {
        // ----------------------------------------------------------------
        // setup your test

        $ref = new ReflectionClass(PaymentNotificationV1::class);
        $unit = $ref->newInstanceArgs($payload);
        $expectedResult = $payload['parentReference'];

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $unit->getParentReference();

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::getEntityVersion
     * @dataProvider provideExampleNotifications
     */
    public function testCanGetEntityVersion(array $payload): void
    {
        // ----------------------------------------------------------------
        // setup your test

        $ref = new ReflectionClass(PaymentNotificationV1::class);
        $unit = $ref->newInstanceArgs($payload);
        $expectedResult = $payload['entityVersion'];

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $unit->getEntityVersion();

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    public function provideExampleNotifications(): array
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
                    'receiptReference' => 'TEST-12345-67890',
                    'amount' => 0.0,
                    'parentReference' => "PARENT-98765-4321",
                    'entityVersion' => 314,
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

    public function provideNonDateTimes(): array
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
