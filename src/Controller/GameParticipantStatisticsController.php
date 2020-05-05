<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GameParticipantStatisticsController extends AbstractController
{
    /**
     * @Route("/game/participant/statistics", name="game_participant_statistics")
     */
    public function index()
    {
        return $this->render('game_participant_statistics/index.html.twig', [
            'controller_name' => 'GameParticipantStatisticsController',
        ]);
    }
}
