<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Entity\User;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class UsersController extends AbstractController
{
    private $userRepository;
    private $entityManager;
    public function __construct(UserRepository $userRepository,  EntityManagerInterface $entityManager)
    {
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
    }


    #[Route('/register', methods:['GET', 'POST'], name: 'register')]
    public function register(Request $request, ValidatorInterface $validator, MailerInterface $mailer): Response
    {
        if ($request->isMethod('POST')) {
            $data = json_decode($request->getContent(), true);
            $user = new User();

            $user->setFirstName($data['firstName']);
            $user->setLastName($data['lastName']);
            $user->setEmail($data['email']);
            $user->setPassword($data['password']);
            $user->setDescribeUser($data['describeUser']);
            $user->setTestingSystems($data['testingSystems']);
            $user->setreportingSystems($data['reportingSystems']);
            $user->setSeleniumKnowledge($data['seleniumKnowledge']);
            $user->setprojectMethodologies($data['projectMethodologies']);
            $user->setScrumKnowledge($data['scrumKnowledge']);
            $user->setIdeEnvironments($data['ideEnvironments']);
            $user->setProgrammingLanguages($data['programmingLanguages']);
            $user->setMysqlKnowledge($data['mysqlKnowledge']);
            $user->setPosition($data['position']);

            $errors = $validator->validate($user);

            if ($errors->count() > 0) {
                foreach ($errors as $error) {
                    $errorMessage = $error->getMessage();
                }
                return $this->json(['errors' => $errorMessage], 400);
            }

            $classMetadata = $this->entityManager->getClassMetadata(User::class);
            $requiredFields = [];

            foreach ($classMetadata->getFieldNames() as $fieldName) {
                if ($classMetadata->isNullable($fieldName) === false && $fieldName != 'id') {
                    $requiredFields[] = $fieldName;
                }
            }

            foreach ($requiredFields as $field) {
                if (empty($data[$field])) {
                    return $this->json(['errors' => "Field $field is required."], 400);
                }
            }

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            $newEmail = (new TemplatedEmail())
                ->from($this->getParameter('app.mailer_address'))
                ->to($data['email'])
                ->subject("Potwierdzono logowanie")
                ->htmlTemplate('emails/confirm.html.twig')
                ->context([
                    'data' => $data,
                ]);

            $mailer->send($newEmail);


            return $this->json($data);
        }

        return $this->render('users/register.html.twig');
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
