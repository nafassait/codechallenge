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
 * @see http://www.example.com/pear
 *
 */
class Url_Parser
{
    public function mergeUrlParams($url1, $url2)
    {
        return array_merge($this->retrieveQueryParams ($url1), $this->retrieveQueryParams($url2));
    }

    public function retrieveQueryParams ($url) {
        //retrieve the url query component and turn the url's query string into an array
        parse_str(parse_url($url, PHP_URL_QUERY),$query_string_array);
        return $query_string_array;
    }
}