<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {

        return $this->render('home/index.html.twig');
    }

    /**
     * @return Response
     * @Route("/apropos", name="apropos")
     */
    public function profil():Response
    {
        return $this->render('apropos.html.twig');
    }

}



