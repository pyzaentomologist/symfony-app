<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{
    private $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    #[Route('/users', name: 'app_users')]
    public function index(): Response
    {
        $users = ['a@gmail.com', 'b@gmail.com'];
        // $users = $this->userRepository->findAll();
        dump($users);
        return $this->render('react.html.twig', array(
            'users' => $users
        ));
    }

}
