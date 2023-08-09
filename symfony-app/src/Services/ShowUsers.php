<?php

namespace App\Services;

use App\Repository\UserRepository;
class ShowUsers
{
   private $userRepository;

   public function __construct(UserRepository $userRepository)
   {
       $this->userRepository = $userRepository;
   }

   public function show()
   {

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
        return $usersData;
    }
}