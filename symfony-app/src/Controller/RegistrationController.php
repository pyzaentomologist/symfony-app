<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\CreateUser;
use Exception;
class RegistrationController extends AbstractController
{

    #[Route('/register', methods:['GET', 'POST'], name: 'register')]
    public function register(Request $request, CreateUser $createUser): Response
    {
        if ($request->isMethod('POST')) {
            try {
                $user = $createUser->create($request);
                if(isset($user['errors'])){
                    return $this->json($user, 400);
                }
                return $this->json($user);
            } catch (Exception $ex){

                $this->addFlash('danger', $ex->getMessage());
            }
        }
        return $this->render('auth/register.html.twig');
    }


    #[Route('/login', methods:['GET', 'POST'], name: 'login')]
    public function login(Request $request): Response
    {
        return $this->render('users/login.html.twig');
    }
}
