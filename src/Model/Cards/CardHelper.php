<?php

namespace App\Model\Cards;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CardHelperRepository")
 */
class CardHelper
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Model\Cards\Card", mappedBy="helpers")
     */
    private $card;

    /**
     * @ORM\ManyToOne(targetEntity="App\Model\Cards\CardTitle", inversedBy="helper")
     */
    private $title;

    public function __construct()
    {
        $this->card = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $card->setHelpers($this);
        }

        return $this;
    }

    public function removeCard(Card $card): self
    {
        if ($this->card->contains($card)) {
            $this->card->removeElement($card);
            // set the owning side to null (unless already changed)
            if ($card->getHelpers() === $this) {
                $card->setHelpers(null);
            }
        }

        return $this;
    }

    public function getTitle(): ?CardTitle
    {
        return $this->title;
    }

    public function setTitle(?CardTitle $title): self
    {
        $this->title = $title;

        return $this;
    }
}
