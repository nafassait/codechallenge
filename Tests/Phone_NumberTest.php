<?php

namespace Challenge;

require '../Phone_Number.php';

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
        //$inputFile = $this->getMock('Phone_Number', array('format'), array("8018640759"));
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
