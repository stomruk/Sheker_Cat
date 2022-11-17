<?php

namespace App\Entity;

use App\Repository\DevelopperRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DevelopperRepository::class)]
class Developper
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\OneToOne(mappedBy: 'Developper', cascade: ['persist', 'remove'])]
    private ?Games $games = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getGames(): ?Games
    {
        return $this->games;
    }

    public function setGames(?Games $games): self
    {
        // unset the owning side of the relation if necessary
        if ($games === null && $this->games !== null) {
            $this->games->setDevelopper(null);
        }

        // set the owning side of the relation if necessary
        if ($games !== null && $games->getDevelopper() !== $this) {
            $games->setDevelopper($this);
        }

        $this->games = $games;

        return $this;
    }
}
