<?php

namespace App\Services;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ValidateUser extends AbstractController{
  private $entityManager;
  private $validator;
  public function __construct(EntityManagerInterface $entityManager, ValidatorInterface $validator)
  {
		$this->validator = $validator;
		$this->entityManager = $entityManager;
  }

	public function validateData($user, $data): array {

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
		   if ($classMetadata->isNullable($fieldName) === false && $fieldName != 'id' && $fieldName != 'roles' && $fieldName != 'password') {
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
  	return [];
 }
}