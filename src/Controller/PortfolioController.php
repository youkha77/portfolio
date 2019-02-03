<?php
/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 18/12/2018
 * Time: 12:15
 */

namespace App\Controller;


use App\Entity\Articles;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PortfolioController extends AbstractController
{
    /**
     * @return Response
     * @Route("/portfolio", name="portfolio")
     */
    public function affiche():Response
    {
        $repo = $this->getDoctrine()->getRepository(Articles::class);
        $article=$repo->findAll();

        return $this->render('portfolio/portfolio.html.twig',[
            'article' => $article
        ]);
    }


    /**
     * @return Response
     * @Route("/portfolio/details/{slug}" ,name="portfolio_slug")
     */
    public function details($slug):Response
    {
        $repo = $this->getDoctrine()->getRepository(Articles::class);
        $article = $repo->find($slug);


        return $this->render('portfolio/details.html.twig',[
            'article'=>$article
        ]);

    }






}