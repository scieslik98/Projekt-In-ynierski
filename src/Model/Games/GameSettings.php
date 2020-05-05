<?php

namespace App\Model\Games;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GameSettingsRepository")
 */
class GameSettings
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }

    // czas trwania gry
    // jakie kategorie kart
    // jaka trudność kart
    // czy z wykrywaniem mowy czy bez
}
