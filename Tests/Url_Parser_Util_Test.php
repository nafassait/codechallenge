<?php

namespace Challenge;

require '../Url_Parser_Util.php';

/**
 * Class Url_ParserTest
 *
 * A class extending PHPUnit Framework for code coverage
 *
 *
 * @package Challenge
 * @author Nafas Sait <nafassait@gmail.com>
 * @see https://github.com/nafassait/codechallenge/
 *
 */
class Url_Parser_Util_Test extends \PHPUnit_Framework_TestCase
{

    private $Url_Parser;

    protected function setUp()
    {
        $this->Url_Parser = new Url_Parser_Util();
    }

    protected function tearDown()
    {
        unset($this->Url_Parser);
    }


    /**
     * @param string $originalString String to be formatted
     * @param string $expectedResult What we expect our result to be
     *
     * @dataProvider providerValidURLs
     */
    public function testValidURLs($url)
    {
        $this->assertTrue((boolean)$this->Url_Parser->validateURL($url));
    }

    public function providerValidURLs()
    {
        return array(
            array("http://www.example.com/"),
            array("https://www.example.com"),
            array("www.example.com/cat/sub?queryhash=1&asd=2"),
            array("www.example.com?queryhash=asdf&asd=qrs")
        );
    }

    /**
     * @param string $originalString String to be formatted
     * @param string $expectedResult What we expect our result to be
     *
     * @dataProvider providerInvalidURLs
     */
    public function testInvalidURLs($url)
    {
        $this->assertFalse($this->Url_Parser->validateURL($url));
    }

    public function providerInvalidURLs()
    {
        return array(
            array("asdf"),
            array("http://"),
            array("http://."),
            array("http://?"),
             array("1234")
        );
    }


    /**
     * @param string $originalString String to be formatted
     * @param string $expectedResult What we expect our result to be
     *
     * @dataProvider providerTestRetrieveQueryParams
     */
    public function testRetrieveQueryParams($originalString, $expectedResult)
    {
        $this->Url_Parser->retrieveQueryParams($originalString);
        $this->assertEquals($this->Url_Parser->retrieveQueryParams($originalString), $expectedResult);
    }

    public function providerTestRetrieveQueryParams()
    {
        return array(
            array("www.example.com/cat/sub?queryhash=1&asd=2", array("queryhash" => 1, "asd" => 2)),
            array("www.example.com?queryhash=asdf&asd=qrs", array("queryhash" => "asdf", "asd" => "qrs"))
        );
    }

    /**
     * @param string $originalString String to be formatted
     * @param string $expectedResult What we expect our result to be
     *
     * @dataProvider providerTestMergeUrlParams
     */
    public function testMergeUrlParams($url1, $url2, $expectedResult)
    {
        $result = $this->Url_Parser->mergeUrlParams($url1, $url2);
        $this->assertEquals($result, $expectedResult);
    }

    public function providerTestMergeUrlParams()
    {
        return array(
            array('www.example.com/cat/sub?myqueryhash=1&asd=2', 'www.google.com/subcategory?myqueryhash2=12&asd2=22',
                array("myqueryhash" => 1, "asd" => 2, "myqueryhash2" => 12, "asd2" => 22)
            ),
            array('www.example.com?queryhash=asdf&asd=qrs', 'www.google.com/subcategory?myqueryhash2=12&asd2=22',
                array("queryhash" => "asdf", "asd" => "qrs", "myqueryhash2" => 12, "asd2" => 22)
            )
        );
    }

    public function testUrlWithoutUrlParams()
    {
        $result = $this->Url_Parser->mergeUrlParams('www.example.com/cat/sub', 'www.google.com');
        $this->assertFalse((bool) $result);
    }

    public function testUrlWithandWithoutUrlParams()
    {
        $result = $this->Url_Parser->mergeUrlParams('www.example.com/cat/sub', 'www.google.com/subcategory?myqueryhash2=12&asd2=22');
        $this->assertEquals(array("myqueryhash2" => 12, "asd2" => 22), $result);
    }

    public function testUrlWithemptyurls()
    {
        $result = $this->Url_Parser->mergeUrlParams('', 'www.google.com/subcategory?myqueryhash2=12&asd2=22');
        $this->assertEquals(array("myqueryhash2" => 12, "asd2" => 22), $result);

        $result = $this->Url_Parser->mergeUrlParams('', '');
        $this->assertFalse((bool) $result);

    }
}
