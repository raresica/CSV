<?php

namespace App\Entity;

use App\Repository\CsvFileRepository;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: CsvFileRepository::class)]
class CsvFile
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255,nullable: true)]
    private ?string $fileName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nane = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    public ?string $entityType = null;
    public ?string $columnA = null;
    public ?string $columnB = null;
    public ?string $columnC = null;
    public ?string $columnD = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function getNane(): ?string
    {
        return $this->nane;
    }

    public function setNane(?string $nane): self
    {
        $this->nane = $nane;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
