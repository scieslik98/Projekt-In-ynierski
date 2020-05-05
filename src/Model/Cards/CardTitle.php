<?php

namespace App\Model\Cards;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CardTitleRepository")
 */
class CardTitle
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
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Model\Cards\Card", mappedBy="title")
     */
    private $card;

    /**
     * @ORM\OneToMany(targetEntity="App\Model\Cards\Card", mappedBy="title")
     */
    private $helper;

    public function __construct()
    {
        $this->card = new ArrayCollection();
        $this->helper = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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
            $card->setTitle($this);
        }

        return $this;
    }

    public function removeCard(Card $card): self
    {
        if ($this->card->contains($card)) {
            $this->card->removeElement($card);
            // set the owning side to null (unless already changed)
            if ($card->getTitle() === $this) {
                $card->setTitle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Card[]
     */
    public function getHelper(): Collection
    {
        return $this->helper;
    }

    public function addHelper(Card $helper): self
    {
        if (!$this->helper->contains($helper)) {
            $this->helper[] = $helper;
            $helper->setTitle($this);
        }

        return $this;
    }

    public function removeHelper(Card $helper): self
    {
        if ($this->helper->contains($helper)) {
            $this->helper->removeElement($helper);
            // set the owning side to null (unless already changed)
            if ($helper->getTitle() === $this) {
                $helper->setTitle(null);
            }
        }

        return $this;
    }
}
