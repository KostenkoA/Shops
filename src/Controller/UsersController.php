<?php

namespace App\Controller;


use App\Entity\Users;
use App\Form\UserRegistration;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UsersController extends AbstractController
{
    public function createRegistrationForm(Request $request)
    {
        $user = new Users();
        $form = $this->createForm(UserRegistration::class, $user);
        $form->handleRequest($request);


        return $this->render('registration/registration.html.twig', [
            'form' => $form->createView(),
        ]);

    }
}