<?php

namespace App\Services;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ShowUser extends AbstractController
{
   private $userRepository;

   public function __construct(UserRepository $userRepository)
   {
       $this->userRepository = $userRepository;
   }

   public function showUser($id)
   {

	    $user = $this->userRepository->find($id);

        if (!$user) {
            throw new \InvalidArgumentException('User not found.');
        }
        $userArray = [
            'id' => $user->getId(),
            'roles' => $user->getRoles(),
            'firstName' => $user->getFirstName(),
            'lastName' => $user->getLastName(),
            'describeUser' => $user->getDescribeUser(),
            'position' => $user->getPosition(),
            'testingSystems' => $user->getTestingSystems(),
            'reportingSystems' => $user->getReportingSystems(),
            'seleniumKnowledge' => $user->isSeleniumKnowledge(),
            'projectMethodologies' => $user->getProjectMethodologies(),
            'scrumKnowledge' => $user->isScrumKnowledge(),
            'ideEnvironments' => $user->getIdeEnvironments(),
            'programmingLanguages' => $user->getProgrammingLanguages(),
            'mysqlKnowledge' => $user->isMysqlKnowledge(),
        ];

        return $userArray;
    }
}