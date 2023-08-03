<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $describeUser = null;

    #[ORM\OneToOne(mappedBy: 'userId', cascade: ['persist', 'remove'])]
    private ?Tester $tester = null;

    #[ORM\OneToOne(mappedBy: 'userId', cascade: ['persist', 'remove'])]
    private ?Developer $developer = null;

    #[ORM\OneToOne(mappedBy: 'userId', cascade: ['persist', 'remove'])]
    private ?ProjectManager $projectManager = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

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

    public function getTester(): ?Tester
    {
        return $this->tester;
    }

    public function setTester(Tester $tester): static
    {
        // set the owning side of the relation if necessary
        if ($tester->getUserId() !== $this) {
            $tester->setUserId($this);
        }

        $this->tester = $tester;

        return $this;
    }

    public function getDeveloper(): ?Developer
    {
        return $this->developer;
    }

    public function setDeveloper(Developer $developer): static
    {
        // set the owning side of the relation if necessary
        if ($developer->getUserId() !== $this) {
            $developer->setUserId($this);
        }

        $this->developer = $developer;

        return $this;
    }

    public function getProjectManager(): ?ProjectManager
    {
        return $this->projectManager;
    }

    public function setProjectManager(ProjectManager $projectManager): static
    {
        // set the owning side of the relation if necessary
        if ($projectManager->getUserId() !== $this) {
            $projectManager->setUserId($this);
        }

        $this->projectManager = $projectManager;

        return $this;
    }


}
