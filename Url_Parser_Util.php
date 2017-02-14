<?php

namespace Challenge;

/**
 * Class Url_Parser
 *
 * A class to with a function that takes a 2 URLs as parameters.
 * The function will read the query parameters of the URLs, merges them
 * and returns the merged array.
 *
 * Url_Parser usage:
 * $Url_Parser = new Url_Parser();
 * $result = $Url_Parser->mergeUrlParams('www.example.com/cat/sub?myquery=1&asd=2', 'www.google.com/?myquery2=12&asd2=22');
 *
 * @package Challenge
 * @author Nafas Sait <nafassait@gmail.com>
 * @see https://github.com/nafassait/codechallenge/
 *
 */
class Url_Parser_Util
{

    public function validateURL($url)
    {
        $url = trim($url);
        if (preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $url)) {
            return $url;
        }
        return false;
    }

    public function mergeUrlParams($url1, $url2)
    {
        return array_merge($this->retrieveQueryParams($url1), $this->retrieveQueryParams($url2));
    }

    public function retrieveQueryParams($url)
    {

        if ($this->validateURL($url)) {

            //retrieve the url query component and turn the url's query string into an array
            parse_str(parse_url($url, PHP_URL_QUERY), $query_string_array);
            return $query_string_array;
        }
        return array();
    }
}


/*$Url_Parser = new Url_Parser_Util();
var_dump($Url_Parser->validateURL('asdf'));exit;*/

//var_dump($Url_Parser->mergeUrlParams('www.example.com/cat/sub?myqueryhash=1&asd=2', 'www.google.com/subcategory?myqueryhash2=12&asd2=22'));*/