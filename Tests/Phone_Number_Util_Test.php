<?php

namespace Challenge;

require '../Phone_Number_Util.php';

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
class Phone_Number_Util_Test extends \PHPUnit_Framework_TestCase
{

    /**
     * @param string $originalString String to be formatted
     * @param string $expectedResult What we expect our result to be
     *
     * @dataProvider providerTestFormat
     */

    public function testItCanFormatSuccess($originalString, $expectedResult)
    {
        $phoneNumber = new Phone_Number_Util($originalString);
        $this->assertEquals($expectedResult, $phoneNumber->format());
    }

    /**
     * This function will cover 3 different success scenarios
     * under one test method
     */
    public function providerTestFormat()
    {
        return array(
            array("8018640759", "801-864-0759"),
            array("801 864 0759", "801-864-0759"),
            array("801a864c0759d", "801-864-0759"),

        );
    }


    public function testEmptyValidationFailure()
    {
        $phoneNumber = new Phone_Number_Util('');
        $this->assertFalse($phoneNumber->format());
    }

    public function testNumberValidationFailure() {
        $phoneNumber = new Phone_Number_Util("801864");
        $this->assertFalse($phoneNumber->format());
    }

    public function testStringValidationFailure()
    {
        $phoneNumber = new Phone_Number_Util("abcdefg");
        $this->assertFalse($phoneNumber->format());
    }

    public function testHtmlValidationFailure()
    {
        $phoneNumber = new Phone_Number_Util('<a href="#"></a>');
        $this->assertFalse($phoneNumber->format());
    }

    public function testSpecialCharValidationFailure()
    {
        $phoneNumber = new Phone_Number_Util('This! @string#$ %$will ()be "sluggified');
        $this->assertFalse($phoneNumber->format());
    }

    public function testOverBoundValidationFailure() {
        $phoneNumber = new Phone_Number_Util("+18018640759");
        $this->assertFalse($phoneNumber->format());
    }
}