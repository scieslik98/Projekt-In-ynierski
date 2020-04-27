<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;


class AppController extends AbstractController
{

    /**
     *@Route("/{reactRouting}", name="index", defaults={"reactRouting": null})
     */
    // * @Route("/app", name="app")
    // @Route("/{reactRouting}", name="index", defaults={"reactRouting": null})
    public function index()
    {
        return $this->render('app/index.html.twig');
    }

}
