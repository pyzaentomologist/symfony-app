<?php

namespace App\Services;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Services\ValidateUser;

class EditUser extends AbstractController{
  private $entityManager;
  private $validateUser;
  private $userPasswordHasher;
  public function __construct(EntityManagerInterface $entityManager,UserPasswordHasherInterface $userPasswordHasher, ValidateUser $validateUser)
  {
		$this->validateUser = $validateUser;
		$this->entityManager = $entityManager;
		$this->userPasswordHasher = $userPasswordHasher;
  }

	public function edit($id, Request $request): array {

    $data = json_decode($request->getContent(), true);

				$user = $this->entityManager->getRepository(User::class)->find($id);

		if($data['password']){
			$hasherdPassword = $this->userPasswordHasher->hashPassword($user, $data['password']);
			$user->setPassword($hasherdPassword);
		}
		$data['username'] = $user->getUsername();
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


		return ['user' => $user];
	}
}