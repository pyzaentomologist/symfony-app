<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{
    #[Route('/users', name: 'app_users')]
    public function index(): Response
    {
        $users = ['1@gmail.com', '12@gmail.com', '3@gmail.com', '4@gmail.com', '5@gmail.com'];
        return $this->render('index.html.twig', array(
            'users' => $users
        ));
    }
}
