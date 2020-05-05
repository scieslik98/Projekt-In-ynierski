<?php

namespace App\Model\Cards;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CardCategoryRepository")
 */
class CardCategory
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Model\Cards\Card", mappedBy="category")
     */
    private $card;

    public function __construct()
    {
        $this->card = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Card[]
     */
    public function getCard(): Collection
    {
        return $this->card;
    }

    public function addCard(Card $card): self
    {
        if (!$this->card->contains($card)) {
            $this->card[] = $card;
            $card->setCategory($this);
        }

        return $this;
    }

    public function removeCard(Card $card): self
    {
        if ($this->card->contains($card)) {
            $this->card->removeElement($card);
            // set the owning side to null (unless already changed)
            if ($card->getCategory() === $this) {
                $card->setCategory(null);
            }
        }

        return $this;
    }

}
