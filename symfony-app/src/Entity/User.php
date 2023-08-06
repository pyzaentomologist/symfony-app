<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: 'email', message: 'This email is already in use.')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $describeUser = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $testingSystems = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $reportingSystems = null;

    #[ORM\Column(nullable: true)]
    private ?bool $seleniumKnowledge = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $projectMethodologies = null;

    #[ORM\Column(nullable: true)]
    private ?bool $scrumKnowledge = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ideEnvironments = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $programmingLanguages = null;

    #[ORM\Column(nullable: true)]
    private ?bool $mysqlKnowledge = null;

    #[ORM\Column(length: 255)]
    private ?string $position = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getDescribeUser(): ?string
    {
        return $this->describeUser;
    }

    public function setDescribeUser(?string $describeUser): static
    {
        $this->describeUser = $describeUser;

        return $this;
    }

    public function getTestingSystems(): ?string
    {
        return $this->testingSystems;
    }

    public function setTestingSystems(?string $testingSystems): static
    {
        $this->testingSystems = $testingSystems;

        return $this;
    }

    public function isSeleniumKnowledge(): ?bool
    {
        return $this->seleniumKnowledge;
    }

    public function setSeleniumKnowledge(?bool $seleniumKnowledge): static
    {
        $this->seleniumKnowledge = $seleniumKnowledge;

        return $this;
    }

    public function getprojectMethodologies(): ?string
    {
        return $this->projectMethodologies;
    }

    public function setprojectMethodologies(?string $projectMethodologies): static
    {
        $this->projectMethodologies = $projectMethodologies;

        return $this;
    }

    public function getreportingSystems(): ?string
    {
        return $this->reportingSystems;
    }

    public function setreportingSystems(?string $reportingSystems): static
    {
        $this->reportingSystems = $reportingSystems;

        return $this;
    }

    public function isScrumKnowledge(): ?bool
    {
        return $this->scrumKnowledge;
    }

    public function setScrumKnowledge(?bool $scrumKnowledge): static
    {
        $this->scrumKnowledge = $scrumKnowledge;

        return $this;
    }

    public function getIdeEnvironments(): ?string
    {
        return $this->ideEnvironments;
    }

    public function setIdeEnvironments(?string $ideEnvironments): static
    {
        $this->ideEnvironments = $ideEnvironments;

        return $this;
    }

    public function getProgrammingLanguages(): ?string
    {
        return $this->programmingLanguages;
    }

    public function setProgrammingLanguages(?string $programmingLanguages): static
    {
        $this->programmingLanguages = $programmingLanguages;

        return $this;
    }

    public function isMysqlKnowledge(): ?bool
    {
        return $this->mysqlKnowledge;
    }

    public function setMysqlKnowledge(?bool $mysqlKnowledge): static
    {
        $this->mysqlKnowledge = $mysqlKnowledge;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(string $position): static
    {
        $this->position = $position;

        return $this;
    }
}
