<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\UserRegistration;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UsersController extends AbstractController
{
    public function editUser(int $userId)
    {
        $em = $this->getDoctrine();

        $user = $em->getRepository(User::class)->find($userId);

        return $this->render('profile/user.html.twig', [
            'userInfo' => $user,
        ]);
    }

    //TODO
}