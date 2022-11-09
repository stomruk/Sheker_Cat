<?php

namespace App\Entity;

use App\Repository\AvatarRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AvatarRepository::class)]
class Avatar
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?AvatarColor $Skin = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?AvatarPart $Head = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?AvatarPart $Hair = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSkin(): ?AvatarColor
    {
        return $this->Skin;
    }

    public function setSkin(?AvatarColor $Skin): self
    {
        $this->Skin = $Skin;

        return $this;
    }

    public function getHead(): ?AvatarPart
    {
        return $this->Head;
    }

    public function setHead(?AvatarPart $Head): self
    {
        $this->Head = $Head;

        return $this;
    }

    public function getHair(): ?AvatarPart
    {
        return $this->Hair;
    }

    public function setHair(?AvatarPart $Hair): self
    {
        $this->Hair = $Hair;

        return $this;
    }
}
