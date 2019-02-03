<?php
/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 20/12/2018
 * Time: 16:20
 */

namespace App\Controller;


use App\Entity\User;
use App\Form\UserEditType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{

    /**
     * @param User $user
     * @return Response
     * @Route("/user/edit/{id}", name="user")
     */
    public function updateUser(User $user, Request $request):Response
    {
        $editform = $this->createForm(UserEditType::class , $user);


        $editform->handleRequest($request);

        if ($editform->isSubmitted() && $editform->isValid()) {
            $user = $editform->getData();
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($user);
            $manager->flush();
        }

        return $this->render('user.html.twig',[
            'editForm' => $editform->createView()
        ]);

    }
}