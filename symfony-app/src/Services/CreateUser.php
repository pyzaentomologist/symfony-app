<?php

namespace App\Services;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Services\SendWelcomeEmail;
use App\Services\ValidateUser;

class CreateUser extends AbstractController{
  private $entityManager;
  private $validateUser;
  private $sendWelcomeEmail;
  private $userPasswordHasher;
  public function __construct(EntityManagerInterface $entityManager, SendWelcomeEmail $sendWelcomeEmail, ValidateUser $validateUser, UserPasswordHasherInterface $userPasswordHasher)
  {
		$this->validateUser = $validateUser;
		$this->entityManager = $entityManager;
		$this->sendWelcomeEmail = $sendWelcomeEmail;
		$this->userPasswordHasher = $userPasswordHasher;
  }

	public function create(Request $request): array {

    $data = json_decode($request->getContent(), true);

		$user = new User($data);

    $hasherdPassword = $this->userPasswordHasher->hashPassword($user, $data['password']);

		$user->setUsername($data['username']);
		$user->setRoles(['ROLE_USER']);
		$user->setPassword($hasherdPassword);
		$user->setFirstName($data['firstName']);
		$user->setLastName($data['lastName']);
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

		$validationResult = $this->validateUser->validateData($user, $data);

		if (isset($validationResult['errors'])) {
						return $validationResult;
		}

    $this->entityManager->persist($user);
    $this->entityManager->flush();

		$this->sendWelcomeEmail->sendEmailToRegisteredUser(['user' => $user, 'password' => $data['password']]);

		return ['user' => $user];
	}
}