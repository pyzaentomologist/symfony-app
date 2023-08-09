<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

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
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $users = $this->userRepository->findAll();
        $usersData = [];
        foreach ($users as $user) {
            $userData = [
                'id' => $user->getId(),
                'firstName' => $user->getFirstName(),
                'lastName' => $user->getLastName(),
                'username' => $user->getUsername(),
                'describeUser' => $user->getDescribeUser(),
                'testingSystems' => $user->getTestingSystems(),
                'seleniumKnowledge' => $user->isSeleniumKnowledge(),
                'projectMethodologies' => $user->getprojectMethodologies(),
                'reportingSystems' => $user->getreportingSystems(),
                'scrumKnowledge' => $user->isScrumKnowledge(),
                'ideEnvironments' => $user->getIdeEnvironments(),
                'programmingLanguages' => $user->getProgrammingLanguages(),
                'mysqlKnowledge' => $user->isMysqlKnowledge(),
                'position' => $user->getPosition(),
            ];
            $usersData[] = $userData;
        }

        return $this->render('admin/admin.html.twig', array(
            'users' => $usersData
        ));
    }

    #[Route('/admin/{id}', methods: ['GET'], name: 'app_user')]
    public function show($id): Response
    {
        $user = $this->userRepository->find($id);
        dump($user);
        return $this->render('users/users.html.twig', array(
            'user' => $user
        ));
    }

    #[Route('/admin/delete/{id}', methods: ['GET', 'DELETE'], name: 'delete_user')]
    public function delete($id): Response
    {
        $user = $this->userRepository->find($id);


        $this->entityManager->remove($user);
        $this->entityManager->flush();


        return $this->json([
            'message' => "Delete"
        ]);
    }

}
