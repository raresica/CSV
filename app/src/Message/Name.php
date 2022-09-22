<?php

namespace App\Message;

class Name
{
    private $first_name;
    private $last_name;
    private $email;
    private $phone_number;

    /**
     * @param $first_name
     * @param $last_name
     * @param $email
     * @param $phone_number
     */
    public function __construct($first_name, $last_name, $email, $phone_number)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->phone_number = $phone_number;
    }

    /**$user
     * @return mixed
     */
    public function getFirstName():string
    {
        return $this->first_name;
    }

    /**
     * @return mixed
     */
    public function getLastName():string
    {
        return $this->last_name;
    }

    /**
     * @return mixed
     */
    public function getEmail():string
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber():string
    {
        return $this->phone_number;
    }


}