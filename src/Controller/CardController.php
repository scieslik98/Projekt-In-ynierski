<?php

namespace App\Controller;

use App\Model\Cards\Interfaces\CardManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class CardController extends AbstractController
{

    private $cardManager;

    public function __construct(CardManagerInterface $cardManager)
    {
        $this->cardManager = $cardManager;
    }

    /**
     * @Route("/card", name="card")
     */
    public function index()
    {
        return $this->render('card/index.html.twig', [
            'controller_name' => 'CardController',
        ]);
    }
}
