<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
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
    #[Route('/register', methods: ['GET'], name: 'register')]
    public function showForm(): Response
    {
        return $this->render('users/register.html.twig');
    }

    #[Route('/register', methods: ['POST'], name: 'registered')]
    public function register(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        $user = new User();

        $user->setFirstName($data['firstName']);
        $user->setLastName($data['lastName']);
        $user->setEmail($data['email']);
        $user->setPassword($data['password']);
        $user->setDescribeUser($data['describeUser']);
        $user->setTestingSystems($data['testingSystems']);
        $user->getreportingSystems($data['reportingSystems']);
        $user->setSeleniumKnowledge($data['seleniumKnowledge']);
        $user->setprojectMethodologies($data['projectMethodologies']);
        $user->setScrumKnowledge($data['scrumKnowledge']);
        $user->setIdeEnvironments($data['ideEnvironments']);
        $user->setProgrammingLanguages($data['programmingLanguages']);
        $user->setMysqlKnowledge($data['mysqlKnowledge']);
        $user->setPosition($data['position']);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $this->json($data);
    }

    #[Route('/admin', name: 'app_users')]
    public function index(): Response
    {
        $users = $this->userRepository->findAll();
        $usersData = [];
        foreach ($users as $user) {
            $userData = [
                'id' => $user->getId(),
                'firstName' => $user->getFirstName(),
                'lastName' => $user->getLastName(),
                'email' => $user->getEmail(),
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
        dump($usersData);
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
}
