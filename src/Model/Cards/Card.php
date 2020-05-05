<?php

namespace App\Model\Cards;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CardRepository")
 */
class Card
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Model\Cards\CardTitle", inversedBy="card")
     */
    private $title;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private $difficulty;

    /**
     * @ORM\ManyToOne(targetEntity="App\Model\Cards\CardCategory", inversedBy="card")
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity="App\Model\Cards\CardHelper", mappedBy="card")
     */
    private $helpers;

    public function __construct()
    {
        $this->helpers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDifficulty()
    {
        return $this->difficulty;
    }

    public function setDifficulty($difficulty): self
    {
        $this->difficulty = $difficulty;

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

    public function getCategory(): ?CardCategory
    {
        return $this->category;
    }

    public function setCategory(?CardCategory $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection|CardHelper[]
     */
    public function getHelpers(): Collection
    {
        return $this->helpers;
    }

    public function addHelper(CardHelper $helper): self
    {
        if (!$this->helpers->contains($helper)) {
            $this->helpers[] = $helper;
            $helper->setCard($this);
        }

        return $this;
    }

    public function removeHelper(CardHelper $helper): self
    {
        if ($this->helpers->contains($helper)) {
            $this->helpers->removeElement($helper);
            // set the owning side to null (unless already changed)
            if ($helper->getCard() === $this) {
                $helper->setCard(null);
            }
        }

        return $this;
    }


}
