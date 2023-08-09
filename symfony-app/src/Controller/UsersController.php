<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Services\EditUser;
use App\Services\ShowUser;
use App\Services\ShowUsers;

use Exception;

class UsersController extends AbstractController
{
    private $userRepository;
    private $entityManager;
    public function __construct(UserRepository $userRepository,  EntityManagerInterface $entityManager)
    {
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
    }

    #[Route('/admin', name: 'admin')]
    public function index(ShowUsers $showUsers): Response
    {
        $usersData = $showUsers->show();

        return $this->render('admin/admin.html.twig', array(
            'users' => $usersData
        ));
    }

    #[Route('/admin/{id}', methods: ['GET', 'POST'], name: 'app_user')]
    public function edit($id, Request $request, EditUser $editUser, ShowUser $showUser): Response
    {

        $user = $showUser->showUser($id);
        // return $this->json($user, 200);
        if ($request->isMethod('POST')) {
            try {
                $user = $editUser->edit($id, $request);
                if(isset($user['errors'])){
                    return $this->json($user, 400);
                }
                return $this->redirectToRoute('admin');
            } catch (Exception $ex){

                $this->addFlash('danger', $ex->getMessage());
            }

            return $this->json($user, 200);
        }
        return $this->render('users/edit.html.twig', [
            'userData' => $user
        ]);
    }

    #[Route('/admin/delete/{id}', methods: ['GET', 'DELETE'], name: 'delete_user')]
    public function delete($id): Response
    {

        $user = $this->userRepository->find($id);


        $this->entityManager->remove($user);
        $this->entityManager->flush();


        return $this->json([
            'message' => "Delete"
        ], 204);

    }

}
