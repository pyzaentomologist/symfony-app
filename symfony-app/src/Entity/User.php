<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['username'], message: 'There is already an account with this username')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $username = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $describeUser = null;

    #[ORM\Column(length: 255)]
    private ?string $position = null;

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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getDescribeUser(): ?string
    {
        return $this->describeUser;
    }

    public function setDescribeUser(?string $describeUser): static
    {
        $this->describeUser = $describeUser;

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

    public function getTestingSystems(): ?string
    {
        return $this->testingSystems;
    }

    public function setTestingSystems(?string $testingSystems): static
    {
        $this->testingSystems = $testingSystems;

        return $this;
    }

    public function getReportingSystems(): ?string
    {
        return $this->reportingSystems;
    }

    public function setReportingSystems(?string $reportingSystems): static
    {
        $this->reportingSystems = $reportingSystems;

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

    public function getProjectMethodologies(): ?string
    {
        return $this->projectMethodologies;
    }

    public function setProjectMethodologies(?string $projectMethodologies): static
    {
        $this->projectMethodologies = $projectMethodologies;

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
}
