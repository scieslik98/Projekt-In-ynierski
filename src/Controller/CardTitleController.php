<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CardTitleController extends AbstractController
{
    /**
     * @Route("/card/title", name="card_title")
     */
    public function index()
    {
        return $this->render('card_title/index.html.twig', [
            'controller_name' => 'CardTitleController',
        ]);
    }
}
