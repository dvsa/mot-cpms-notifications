<?php

namespace DVSA\CPMS\Notifications\Dates\ValueBuilders;

use DateTime;
use DateInterval;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass DVSA\CPMS\Notifications\Dates\ValueBuilders\BuildAcknowledgementDeadlineDate
 */
class BuildAcknowledgementDeadlineDateTest extends TestCase
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

	    $obj = new BuildAcknowledgementDeadlineDate;

	    // ----------------------------------------------------------------
	    // test the results

	    $this->assertInstanceOf(BuildAcknowledgementDeadlineDate::class, $obj);
	}

	/**
	 * @covers ::__invoke
	 * @dataProvider provideDeadlinesToTest
	 */
	public function testCanUseAsObject($timeout, $from, $expectedResult)
	{
	    // ----------------------------------------------------------------
	    // setup your test

	    $obj = new BuildAcknowledgementDeadlineDate;

	    // ----------------------------------------------------------------
	    // perform the change

	    $actualResult = $obj($timeout, $from);

	    // ----------------------------------------------------------------
	    // test the results

	    $this->assertEquals($expectedResult, $actualResult);
	}

	/**
	 * @covers ::from
	 * @dataProvider provideDeadlinesToTest
	 */
	public function testCanCallStatically($timeout, $from, $expectedResult)
	{
	    // ----------------------------------------------------------------
	    // setup your test

	    // ----------------------------------------------------------------
	    // perform the change

	    $actualResult = BuildAcknowledgementDeadlineDate::from($timeout, $from);

	    // ----------------------------------------------------------------
	    // test the results

	    $this->assertEquals($expectedResult, $actualResult);
	}

	/**
	 * @covers ::from
	 * @covers ::__invoke
	 */
	public function testUsesCurrentDateTimeWhenNoStartDateProvided()
	{
	    // ----------------------------------------------------------------
	    // setup your test

		$obj = new BuildAcknowledgementDeadlineDate;
		$timeout = new DateInterval("PT30M");

	    // ----------------------------------------------------------------
	    // perform the change

	    $actualResult1 = $obj($timeout);
	    $actualResult2 = BuildAcknowledgementDeadlineDate::from($timeout);

	    // ----------------------------------------------------------------
	    // test the results
	   	//
	    // because we're not supplying all the inputs, it is possible that
	    // there is a 1 second difference between the output we expect,
	    // and the output that we get
	    //
	    // we need to normalise the result before we can test it
	    //
	    // if we do not, we will get occaisonal failures when we run the
	    // unit tests

	    $expectedResult = new DateTime;
	    $expectedResult->add($timeout);

    	$this->assertEqualsWithDelta($expectedResult, $actualResult1, 1);
    	$this->assertEqualsWithDelta($expectedResult, $actualResult2, 1);
	}

	/**
	 * @covers ::from
	 * @covers ::__invoke
	 */
	public function testDoesNotModifyFromParameter()
	{
	    // ----------------------------------------------------------------
	    // setup your test
	    //
	    // here, we are making sure that the object passed in as the $from
	    // parameter does not get modified by our unit under test

	    $obj = new BuildAcknowledgementDeadlineDate;
	    $timeout = new DateInterval("PT30M");
	    $fromDate = "2015-01-01 14:00:00";
	    $expectedFromDate = new DateTime($fromDate);

	    // ----------------------------------------------------------------
	    // perform the change

	    $from1 = new DateTime($fromDate);
	    $actualResult1 = $obj($timeout, $from1);

	    $from2 = new DateTime($fromDate);
	    $actualResult2 = BuildAcknowledgementDeadlineDate::from($timeout, $from2);

	    // ----------------------------------------------------------------
	    // test the results

	    // make sure the result object is a different object to our $from
	    // parameter
	    $this->assertNotSame($from1, $actualResult1);
	    $this->assertNotSame($from2, $actualResult2);

	    // make sure our $from parameter has not been modified
	    $this->assertEquals($expectedFromDate, $from1);
	    $this->assertEquals($expectedFromDate, $from2);
	}


	public function provideDeadlinesToTest()
	{
		// the test dataset we will return
		$retval = [];

		// a list of the deadline ranges we want to test
		//
		// 0 - when we want to calculate the deadline from
		// 1 - the timeout to apply
		$intervals = [
			[ "2015-01-01 00:00:00", "PT1H", "2015-01-01 01:00:00" ],
			[ "2015-11-05 19:59:59", "PT30M", "2015-11-05 20:29:59" ],
		];

		// because DateTime::add() modifies the original object, we need to
		// build up our test dataset like this
		foreach ($intervals as $data) {
			$from = new DateTime($data[0]);
			$timeout = new DateInterval($data[1]);
			$deadline = new DateTime($data[2]);

			$retval[] = [ $timeout, $from, $deadline ];
		}

		// all done
		return $retval;
	}
}
