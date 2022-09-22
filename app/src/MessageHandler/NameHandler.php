<?php

namespace App\MessageHandler;

use App\Message\Name;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class NameHandler implements MessageHandlerInterface
{
    private EntityManagerInterface $db;

    public function __construct(EntityManagerInterface $db)
    {
        $this->db = $db;
    }

    public function __invoke(Name $name)
    {
        $x=(new \App\Entity\Name())
            ->setFirstName($name->getFirstName())
            ->setLastName($name->getLastName())
            ->setEmail($name->getEmail())
            ->setPhoneNumber($name->getPhoneNumber());
        $this->db->persist($x);
        $this->db->flush();
  }

}