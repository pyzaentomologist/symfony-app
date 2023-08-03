<?php

namespace App\Entity;

use App\Repository\DeveloperRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DeveloperRepository::class)]
class Developer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ideEnvironments = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $programmingLanguages = null;

    #[ORM\Column(nullable: true)]
    private ?bool $mysqlKnowledge = null;

    #[ORM\OneToOne(inversedBy: 'developer', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $userId = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getUserId(): ?User
    {
        return $this->userId;
    }

    public function setUserId(User $userId): static
    {
        $this->userId = $userId;

        return $this;
    }

}
