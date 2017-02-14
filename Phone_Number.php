<?php

namespace Challenge;

/**
 * Class Phone_Number
 *
 * A simple Class for US phone number formatting. Functionality includes formatting, parsing
 * The function will format only numbers with 10 digits
 * Rest of them will be returned after removing characters as it is
 *
 * Phone_Number usage:
 * $phoneUtil = new Phone_Number("8018640759");
 * $number = $phoneUtil->format();
 * echo $number;
 *
 * @package Challenge
 * @author Nafas Sait <nafassait@gmail.com>
 * @see http://www.example.com/pear
 *
 */
class Phone_Number
{

    /**
     * @var string This is to private variable
     * for phone number string
     */
    private $phoneNumber;

    /**
     * PhoneNumber constructor.
     * @param $phoneNumber the input phone number string
     */
    function __construct($phoneNumber)
    {
        $this->phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);
    }

    /**
     * A function to format the phoneNumber for the phone number and returns
     * Complex validations are not part of this function
     *
     * @return mixed|string formatted phone number
     * @access public
     */
    public function format()
    {
        //validate length of the phonenumber
        if (strlen($this->phoneNumber) == 10) {
            $firstThree = substr($this->phoneNumber, 0, 3);
            $nextThree = substr($this->phoneNumber, 3, 3);
            $lastFour = substr($this->phoneNumber, 6, 4);

            $this->phoneNumber = $firstThree . '-' . $nextThree . '-' . $lastFour;
        }

        return $this->phoneNumber;
    }
}