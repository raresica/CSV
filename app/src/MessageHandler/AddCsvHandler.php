<?php

namespace App\MessageHandler;

use App\Entity\CsvFile;
use App\Message\AddCsv;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class AddCsvHandler implements MessageHandlerInterface
{
    private EntityManagerInterface $db;

    public function __construct(EntityManagerInterface $db)
    {
        $this->db = $db;
    }

    public function __invoke(AddCsv $addCsv)
    {
        $x=(new CsvFile())
            ->setNane($addCsv->getName())
            ->setDescription($addCsv->getDescription());

        $this->db->persist($x);
        $this->db->flush();
    }
}