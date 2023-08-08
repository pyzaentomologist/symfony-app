<?php

namespace App\Services;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Services\SendWelcomeEmail;

class CreateUser extends AbstractController{
  private $entityManager;
  private $validator;
  private $sendWelcomeEmail;
  private $userPasswordHasher;
  public function __construct(EntityManagerInterface $entityManager, SendWelcomeEmail $sendWelcomeEmail, ValidatorInterface $validator, UserPasswordHasherInterface $userPasswordHasher)
  {
		$this->validator = $validator;
		$this->entityManager = $entityManager;
		$this->sendWelcomeEmail = $sendWelcomeEmail;
		$this->userPasswordHasher = $userPasswordHasher;
  }

	public function create(Request $request): array {

    $data = json_decode($request->getContent(), true);

		$user = new User($data);

    $hasherdPassword = $this->userPasswordHasher->hashPassword($user, $data['password']);

		$user->setEmail($data['email']);
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

		$errors = $this->validator->validate($user);

    if ($errors->count() > 0) {
			$errorMessages = [];
      foreach ($errors as $error) {
          $errorMessages = $error->getMessage();
      }
      return ['errors' => $errorMessages];
    }

    $classMetadata = $this->entityManager->getClassMetadata(User::class);
    $requiredFields = [];

    foreach ($classMetadata->getFieldNames() as $fieldName) {
        if ($classMetadata->isNullable($fieldName) === false && $fieldName != 'id' && $fieldName != 'roles') {
            $requiredFields[] = $fieldName;
        }
    }

    foreach ($requiredFields as $field) {
        if (empty($data[$field])) {
            return ['errors' => "Field $field is required."];
        }
        if ($data['position'] !== 'tester' && $data['position'] !== 'developer' && $data['position'] !== 'project manager') {
          return ['errors' => "Proszę o podanie właściwego stanowiska"];
        }
    }

    $this->entityManager->persist($user);
    $this->entityManager->flush();

		$this->sendWelcomeEmail->sendEmailToRegisteredUser(['user' => $user, 'password' => $data['password']]);

		return ['user' => $user];
	}
}