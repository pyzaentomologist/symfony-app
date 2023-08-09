<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Services\CreateUser;

use Exception;
class AuthController extends AbstractController
{

    #[Route('/', methods:['GET', 'POST'], name: 'register')]
    public function register(Request $request, CreateUser $createUser): Response
    {
        if ($request->isMethod('POST')) {
            try {
                $user = $createUser->create($request);
                if(isset($user['errors'])){
                    return $this->json($user, 400);
                }
                return $this->redirectToRoute('login');
            } catch (Exception $ex){

                $this->addFlash('danger', $ex->getMessage());
            }
        }
        return $this->render('auth/register.html.twig');
    }


    #[Route('/login', methods:['GET', 'POST'], name: 'login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        if ($error) {

            return $this->json('Wrong login or password', 401);

        }
        return $this->render('auth/login.html.twig', [
            'error' => $error,
            'last_username' => $lastUsername
        ]);
    }

    #[Route('/logout', methods:['GET', 'POST'], name: 'logout')]
    public function logout(): Response
    {



        return $this->redirectToRoute('login');
    }
}
