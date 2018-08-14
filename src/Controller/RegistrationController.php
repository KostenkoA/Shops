<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = new Users();
        $formUser = $this->createForm(UserType::class, $user);

        $formUser->handleRequest($request);

        if ($formUser->isSubmitted() && $formUser->isValid()) {

            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('registration/registration.html.twig', [
           'formUser' => $formUser->createView()
        ]);
    }
}