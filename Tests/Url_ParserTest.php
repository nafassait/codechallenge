<?php

namespace Challenge;

require '../Url_Parser.php';

class Url_ParserTest extends \PHPUnit_Framework_TestCase
{

    private $Url_Parser;

    protected function setUp()
    {
        $this->Url_Parser = new Url_Parser();
    }

    protected function tearDown()
    {
        unset($this->Url_Parser);
    }


    /**
     * @param string $originalString String to be formatted
     * @param string $expectedResult What we expect our result to be
     *
     * @dataProvider providerTestRetrieveQueryParams
     */
    public function testRetrieveQueryParams($originalString, $expectedResult)
    {
        $this->Url_Parser ->retrieveQueryParams($originalString);
        $this->assertEquals($this->Url_Parser->retrieveQueryParams($originalString), $expectedResult);
    }

    public function providerTestRetrieveQueryParams()
    {
        return array(
            array("www.example.com/cat/sub?queryhash=1&asd=2", array("queryhash" => 1,"asd"=>2)),
            array("www.example.com?queryhash=asdf&asd=qrs", array("queryhash" => "asdf","asd"=>"qrs"))
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
        $result = $this->Url_Parser ->mergeUrlParams($url1, $url2);
        $this->assertEquals($result, $expectedResult);
    }

    public function providerTestMergeUrlParams()
    {
        return array(
            array('www.example.com/cat/sub?myqueryhash=1&asd=2','www.google.com/subcategory?myqueryhash2=12&asd2=22',
                array("myqueryhash" => 1,"asd"=>2, "myqueryhash2"=> 12, "asd2"=>22)
            ),
            array('www.example.com?queryhash=asdf&asd=qrs','www.google.com/subcategory?myqueryhash2=12&asd2=22',
                array("queryhash" => "asdf","asd"=>"qrs", "myqueryhash2"=> 12, "asd2"=>22)
            )
        );
    }
}
