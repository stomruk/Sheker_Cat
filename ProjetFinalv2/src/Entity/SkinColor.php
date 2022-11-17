<?php

namespace App\Entity;

use App\Repository\SkinColorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SkinColorRepository::class)]
class SkinColor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $skin = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSkin(): ?string
    {
        return $this->skin;
    }

    public function setSkin(string $skin): self
    {
        $this->skin = $skin;

        return $this;
    }
}
