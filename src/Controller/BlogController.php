<?php

namespace App\Controller;


use App\Entity\Articles;
use App\Entity\Blog;

use App\Form\BlogType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/admin/blog", name="showblog")
     */
    public function blog():Response
    {
        $repo = $this->getDoctrine()->getRepository(Blog::class);
        $blog = $repo->findAll();

        return $this->render('blog/blog.html.twig', [
            'blog' => $blog
        ]);
    }

    /**
     * Suppresion d'un blog
     * @Route("/admin/{slug}/suppressionblog", name="suppblog")
     * @param Blog $blog
     * @return Response
     */
    public function delete(Blog $blog): Response
    {
        // Récupération du manager
        $manager = $this->getDoctrine()->getManager();
        // Exécution du SQL (suppression)
        $manager->remove($blog);
        $manager->flush();
        // Ajout d'un message flash
        $this->addFlash('danger', 'Votre blog a bien été supprimé');
        // Redirection vers l'accueil
        return $this->redirectToRoute('showblog');
    }


    /**
     * @Route("/admin/createblog", name="createblog")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request):Response
    {
        $blog = new Blog();
        $form = $this->createForm(BlogType::class, $blog);

        /* Traitement du formulaire */
        // Récupération $_POST
        $form->handleRequest($request);
        // Vérification validité des données
        if ($form->isSubmitted() && $form->isValid()) {
            // Données valides
            $blog = $form->getData();
            // Insert
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($blog);
            $manager->flush();
            $this->addFlash('success', 'ton article a bien été ajouté');
            return $this->redirectToRoute('showblog');
        }

        return $this->render('blog/create.html.twig',[
            'createForm' => $form->createView()
        ]);
    }

    /**
     * modifier le blog
     * @param Request $request
     * @return Response
     * @Route("/admin/{slug}/updateblog", name="editblog")
     */
    public function update(Blog $blog ,Request $request):Response
    {

        $form = $this->createForm(BlogType::class , $blog);

        /* Traitement du formulaire */
        // Récupération $_POST
        $form->handleRequest($request);
        // Vérification validité des données
        if ($form->isSubmitted() && $form->isValid()) {
            // Données valides
            $articles = $form->getData();
            // Insert
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($blog);
            $manager->flush();
            $this->addFlash('primary', 'Votre blog a bien été modifié');
            return $this->redirectToRoute('showblog');
        }

        return $this->render('blog/edit.html.twig',[
            'createForm' => $form->createView()
        ]);
    }

    /**
     * @return Response
     * @Route("/monblog", name="monblog")
     */
    public function affiche():Response
    {
        $repo = $this->getDoctrine()->getRepository(Blog::class);
        $blog=$repo->findAll();

        return $this->render('blog/blogpublic.html.twig',[
            'blog' => $blog
        ]);
    }






    /**
     * @Route("/europe", name="europe")
     */
    public function europe()
    {
        return $this->render('blog/europe.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }

    /**
     * @Route("/asie", name="asie")
     */
    public function asie()
    {
        return $this->render('blog/asie.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }

    /**
     * @Route("/amsud", name="amsud")
     */
    public function amsud()
    {
        return $this->render('blog/amsud.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }

    /**
     * @Route("/amnord", name="amnord")
     */
    public function amnord()
    {
        return $this->render('blog/amnord.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }

    /**
     * @Route("/aceanie", name="oceanie")
     */
    public function oceanie()
    {
        return $this->render('blog/oceanie.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }




}
