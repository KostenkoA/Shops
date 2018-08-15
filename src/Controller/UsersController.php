<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\UserRegistration;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UsersController extends AbstractController
{
    public function admin()
    {
        return $this->render('admin/admin.html.twig');
    }
}