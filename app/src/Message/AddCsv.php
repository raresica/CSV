<?php

namespace App\Message;

class AddCsv
{
    private $name;
    private $description;

    public function __construct(string $name, string $description)
    {

        $this->name = $name;
        $this->description = $description;

    }

    /**
     * @return mixed
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getDescription(): string
    {
        return $this->description;
    }

}
