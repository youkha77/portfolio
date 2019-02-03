<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Form\ArticlesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{

    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/admin/folio", name="folio")
     */
    public function create(Request $request):Response
    {
        $article = new Articles();
        $form = $this->createForm(ArticlesType::class , $article);

        /* Traitement du formulaire */
        // Récupération $_POST
        $form->handleRequest($request);
        // Vérification validité des données
        if ($form->isSubmitted() && $form->isValid()) {
            // Données valides
            $article = $form->getData();
            // Insert
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($article);
            $manager->flush();
            $this->addFlash('success', 'ton article a bien été ajouté');
            return $this->redirectToRoute('show');
        }

        return $this->render('admin/folio.html.twig',[
        'createForm' => $form->createView()
        ]);
    }


    /**
     * @return Response
     * @Route("/admin/show", name="show")
     */
    public function show():Response
    {
        $repo = $this->getDoctrine()->getRepository(Articles::class);
        $article = $repo->findAll();

        return $this->render('admin/show.html.twig',[
            'article'=> $article
        ]);
    }


    /**
     * modifier
     * @param Request $request
     * @return Response
     * @Route("/admin/{slug}/update", name="edit")
     */
    public function update(Articles $articles ,Request $request):Response
    {

        $form = $this->createForm(ArticlesType::class , $articles);

        /* Traitement du formulaire */
        // Récupération $_POST
        $form->handleRequest($request);
        // Vérification validité des données
        if ($form->isSubmitted() && $form->isValid()) {
            // Données valides
            $articles = $form->getData();
            // Insert
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($articles);
            $manager->flush();
            $this->addFlash('primary', 'Votre article a bien été modifié');
            return $this->redirectToRoute('show');
        }

        return $this->render('admin/edit.html.twig',[
            'createForm' => $form->createView()
        ]);
    }

    /**
     * Suppresion d'un projet
     * @Route("/admin/{slug}/suppression", name="supp")
     * @param Articles $articles
     * @return Response
     */
    public function delete(Articles $articles): Response
    {
        // Récupération du manager
        $manager = $this->getDoctrine()->getManager();
        // Exécution du SQL (suppression)
        $manager->remove($articles);
        $manager->flush();
        // Ajout d'un message flash
        $this->addFlash('danger', 'Votre article a bien été supprimé');
        // Redirection vers l'accueil
        return $this->redirectToRoute('show');
    }


}
