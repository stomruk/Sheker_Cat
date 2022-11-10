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
    private ?AvatarPart $Head = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?AvatarPart $Hair = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?AvatarPart $Eyes = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?AvatarPart $Mouth = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?AvatarPart $Nose = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?AvatarPart $Cloth = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?AvatarColor $Skin = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?AvatarColor $HairColor = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?AvatarColor $EyeColor = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?AvatarColor $ClothStyle = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEyes(): ?AvatarPart
    {
        return $this->Eyes;
    }

    public function setEyes(?AvatarPart $Eyes): self
    {
        $this->Eyes = $Eyes;

        return $this;
    }

    public function getMouth(): ?AvatarPart
    {
        return $this->Mouth;
    }

    public function setMouth(?AvatarPart $Mouth): self
    {
        $this->Mouth = $Mouth;

        return $this;
    }

    public function getNose(): ?AvatarPart
    {
        return $this->Nose;
    }

    public function setNose(?AvatarPart $Nose): self
    {
        $this->Nose = $Nose;

        return $this;
    }

    public function getCloth(): ?AvatarPart
    {
        return $this->Cloth;
    }

    public function setCloth(?AvatarPart $Cloth): self
    {
        $this->Cloth = $Cloth;

        return $this;
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

    public function getHairColor(): ?AvatarColor
    {
        return $this->HairColor;
    }

    public function setHairColor(?AvatarColor $HairColor): self
    {
        $this->HairColor = $HairColor;

        return $this;
    }

    public function getEyeColor(): ?AvatarColor
    {
        return $this->EyeColor;
    }

    public function setEyeColor(?AvatarColor $EyeColor): self
    {
        $this->EyeColor = $EyeColor;

        return $this;
    }

    public function getClothStyle(): ?AvatarColor
    {
        return $this->ClothStyle;
    }

    public function setClothStyle(?AvatarColor $ClothStyle): self
    {
        $this->ClothStyle = $ClothStyle;

        return $this;
    }
}
