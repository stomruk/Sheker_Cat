<?php

namespace App\Entity;

use App\Repository\GamesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GamesRepository::class)]
class Games
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Description = null;

    #[ORM\Column(length: 255)]
    private ?string $Cover = null;

    #[ORM\Column]
    private ?float $Price = null;

    #[ORM\OneToMany(mappedBy: 'Game', targetEntity: Images::class)]
    private Collection $images;



    #[ORM\ManyToMany(targetEntity: Category::class, mappedBy: 'Game')]
    private Collection $categories;

    #[ORM\Column(length: 255)]
    private ?string $Date = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'Game')]
    private Collection $users;

    #[ORM\OneToMany(mappedBy: 'Game', targetEntity: Review::class)]
    private Collection $reviews;

    #[ORM\ManyToMany(targetEntity: Developper::class, mappedBy: 'game')]
    private Collection $developpers;

    #[ORM\ManyToMany(targetEntity: CodePromo::class, mappedBy: 'game')]
    private Collection $codePromos;

    #[ORM\Column(nullable: true)]
    private ?int $Discount = null;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->reviews = new ArrayCollection();
        $this->developpers = new ArrayCollection();
        $this->codePromos = new ArrayCollection();
    }

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

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getCover(): ?string
    {
        return $this->Cover;
    }

    public function setCover(string $Cover): self
    {
        $this->Cover = $Cover;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->Price;
    }

    public function setPrice(float $Price): self
    {
        $this->Price = $Price;

        return $this;
    }

    /**
     * @return Collection<int, Images>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Images $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setGame($this);
        }

        return $this;
    }

    public function removeImage(Images $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getGame() === $this) {
                $image->setGame(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
            $category->addGame($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->categories->removeElement($category)) {
            $category->removeGame($this);
        }

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->Date;
    }

    public function setDate(string $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addGame($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeGame($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Review>
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(Review $review): self
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews->add($review);
            $review->setGame($this);
        }

        return $this;
    }

    public function removeReview(Review $review): self
    {
        if ($this->reviews->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getGame() === $this) {
                $review->setGame(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Developper>
     */
    public function getDeveloppers(): Collection
    {
        return $this->developpers;
    }

    public function addDevelopper(Developper $developper): self
    {
        if (!$this->developpers->contains($developper)) {
            $this->developpers->add($developper);
            $developper->addGame($this);
        }

        return $this;
    }

    public function removeDevelopper(Developper $developper): self
    {
        if ($this->developpers->removeElement($developper)) {
            $developper->removeGame($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, CodePromo>
     */
    public function getCodePromos(): Collection
    {
        return $this->codePromos;
    }

    public function addCodePromo(CodePromo $codePromo): self
    {
        if (!$this->codePromos->contains($codePromo)) {
            $this->codePromos->add($codePromo);
            $codePromo->addGame($this);
        }

        return $this;
    }

    public function removeCodePromo(CodePromo $codePromo): self
    {
        if ($this->codePromos->removeElement($codePromo)) {
            $codePromo->removeGame($this);
        }

        return $this;
    }

    public function getDiscount(): ?int
    {
        return $this->Discount;
    }

    public function setDiscount(?int $Discount): self
    {
        $this->Discount = $Discount;

        return $this;
    }
}
