<?php

namespace App\Entity;

use App\Repository\TesterRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TesterRepository::class)]
class Tester
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $testing_systems = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $reportSystems = null;

    #[ORM\Column(nullable: true)]
    private ?bool $seleniumKnowledge = null;

    #[ORM\OneToOne(inversedBy: 'tester', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $userId = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTestingSystems(): ?string
    {
        return $this->testing_systems;
    }

    public function setTestingSystems(?string $testing_systems): static
    {
        $this->testing_systems = $testing_systems;

        return $this;
    }

    public function getReportSystems(): ?string
    {
        return $this->reportSystems;
    }

    public function setReportSystems(?string $reportSystems): static
    {
        $this->reportSystems = $reportSystems;

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
