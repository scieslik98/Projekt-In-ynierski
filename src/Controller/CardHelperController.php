<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CardHelperController extends AbstractController
{
    /**
     * @Route("/card/helper", name="card_helper")
     */
    public function index()
    {
        return $this->render('card_helper/index.html.twig', [
            'controller_name' => 'CardHelperController',
        ]);
    }
}
