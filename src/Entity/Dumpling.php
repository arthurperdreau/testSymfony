<?php

namespace App\Entity;

use App\Repository\DumplingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DumplingRepository::class)]
class Dumpling
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $filing = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getFiling(): ?string
    {
        return $this->filing;
    }

    public function setFiling(string $filing): static
    {
        $this->filing = $filing;

        return $this;
    }
}
