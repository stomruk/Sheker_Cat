<?php

namespace App\Entity;

use App\Repository\CodePromoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CodePromoRepository::class)]
class CodePromo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $code = null;

    #[ORM\Column]
    private ?int $discount = null;

    #[ORM\ManyToMany(targetEntity: Games::class, inversedBy: 'codePromos')]
    private Collection $game;



    public function __construct()
    {
        $this->game = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getDiscount(): ?int
    {
        return $this->discount;
    }

    public function setDiscount(int $discount): self
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * @return Collection<int, Games>
     */
    public function getGame(): Collection
    {
        return $this->game;
    }

    public function addGame(Games $game): self
    {
        if (!$this->game->contains($game)) {
            $this->game->add($game);
        }

        return $this;
    }

    public function removeGame(Games $game): self
    {
        $this->game->removeElement($game);

        return $this;
    }
}
