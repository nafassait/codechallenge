<?php

namespace Challenge;

require '../Phone_Number.php';

/**
 * Class Phone_NumberTest
 *
 * A class extending PHPUnit Framework for code coverage
 *
 *
 * @package Challenge
 * @author Nafas Sait <nafassait@gmail.com>
 * @see https://github.com/nafassait/codechallenge/
 *
 */
class Phone_NumberTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @param string $originalString String to be formatted
     * @param string $expectedResult What we expect our result to be
     *
     * @dataProvider providerTestFormat
     */

    public function testFormat($originalString, $expectedResult)
    {
        $phoneNumber = new Phone_Number($originalString);
        $this->assertEquals($phoneNumber->format(), $expectedResult);
    }

    public function providerTestFormat()
    {
        return array(
            array("8018640759", "801-864-0759"),
            array("801 864 0759", "801-864-0759"),
            array("801a864c0759d", "801-864-0759")
        );
    }
}
