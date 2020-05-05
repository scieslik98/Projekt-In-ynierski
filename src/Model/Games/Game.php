<?php

namespace App\Model\Games;

use App\Model\Auth\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GameRepository")
 */
class Game
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     *  @var Collection
     *
     * @ORM\ManyToMany(targetEntity="App\Model\Auth\User")
     */
    private $participants;

    /**
     * @ORM\OneToOne(targetEntity="App\Model\Games\GameSettings")
     */
    private $settings;

    /**
     * @ORM\OneToMany(targetEntity="App\Model\Games\GameParticipantStatistics", mappedBy="game")
     */
    private $statistics;

    public function __construct()
    {
        $this->participants = new ArrayCollection();
        $this->statistics = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|User[]
     */
    public function getParticipants(): Collection
    {
        return $this->participants;
    }

    public function addParticipant(User $participant): self
    {
        if (!$this->participants->contains($participant)) {
            $this->participants[] = $participant;
        }

        return $this;
    }

    public function removeParticipant(User $participant): self
    {
        if ($this->participants->contains($participant)) {
            $this->participants->removeElement($participant);
        }

        return $this;
    }

    public function getSettings(): ?GameSettings
    {
        return $this->settings;
    }

    public function setSettings(?GameSettings $settings): self
    {
        $this->settings = $settings;

        return $this;
    }

    /**
     * @return Collection|GameParticipantStatistics[]
     */
    public function getStatistics(): Collection
    {
        return $this->statistics;
    }

    public function addStatistic(GameParticipantStatistics $statistic): self
    {
        if (!$this->statistics->contains($statistic)) {
            $this->statistics[] = $statistic;
            $statistic->setGame($this);
        }

        return $this;
    }

    public function removeStatistic(GameParticipantStatistics $statistic): self
    {
        if ($this->statistics->contains($statistic)) {
            $this->statistics->removeElement($statistic);
            // set the owning side to null (unless already changed)
            if ($statistic->getGame() === $this) {
                $statistic->setGame(null);
            }
        }

        return $this;
    }
}
