<?php

namespace DVSA\CPMS\Notifications\Ids\ValueBuilders;

use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidFactory;
use Ramsey\Uuid\FeatureSet;

/**
 * @coversDefaultClass DVSA\CPMS\Notifications\Ids\ValueBuilders\GenerateNotificationId
 */
class GenerateNotificationIdTest extends TestCase
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

        $obj = new GenerateNotificationId();

        // ----------------------------------------------------------------
        // test the results

        $this->assertInstanceOf(GenerateNotificationId::class, $obj);
    }

    /**
     * @covers ::__invoke
     */
    public function testCanUseAsObject(): void
    {
        // ----------------------------------------------------------------
        // setup your test

        $obj = new GenerateNotificationId();

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $obj();

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue(is_string($actualResult));
        $this->assertEquals(36, strlen($actualResult));
    }

    /**
     * @covers ::now
     */
    public function testCanCallStatically(): void
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = GenerateNotificationId::now();

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue(is_string($actualResult));
        $this->assertEquals(36, strlen($actualResult));
    }

    /**
     * @covers ::now
     * @covers ::__invoke
     */
    public function testGeneratesAString(): void
    {
        // ----------------------------------------------------------------
        // setup your test

        $obj = new GenerateNotificationId();

        // ----------------------------------------------------------------
        // perform the change

        $actualResult1 = $obj();
        $actualResult2 = GenerateNotificationId::now();

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue(is_string($actualResult1));
        $this->assertTrue(is_string($actualResult2));
    }

    /**
     * @covers ::now
     * @covers ::__invoke
     */
    public function testStringsArePureAscii(): void
    {
        // ----------------------------------------------------------------
        // setup your test

        $obj = new GenerateNotificationId();

        // ----------------------------------------------------------------
        // perform the change

        $actualResult1 = $obj();
        $actualResult2 = GenerateNotificationId::now();

        // ----------------------------------------------------------------
        // test the results

        $this->assertMatchesRegularExpression("/[A-Za-z0-9-]{36}/", $actualResult1);
        $this->assertMatchesRegularExpression("/[A-Za-z0-9-]{36}/", $actualResult2);
    }
}
