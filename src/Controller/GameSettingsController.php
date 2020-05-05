<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GameSettingsController extends AbstractController
{
    /**
     * @Route("/game/settings", name="game_settings")
     */
    public function index()
    {
        return $this->render('game_settings/index.html.twig', [
            'controller_name' => 'GameSettingsController',
        ]);
    }
}
