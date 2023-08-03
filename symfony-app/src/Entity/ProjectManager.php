<?php

namespace App\Entity;

use App\Repository\ProjectManagerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectManagerRepository::class)]
class ProjectManager
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $projectManagementMethods = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $reportSystems = null;

    #[ORM\Column(nullable: true)]
    private ?bool $scrumKnowledge = null;

    #[ORM\OneToOne(inversedBy: 'projectManager', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $userId = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProjectManagementMethods(): ?string
    {
        return $this->projectManagementMethods;
    }

    public function setProjectManagementMethods(?string $projectManagementMethods): static
    {
        $this->projectManagementMethods = $projectManagementMethods;

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

    public function isScrumKnowledge(): ?bool
    {
        return $this->scrumKnowledge;
    }

    public function setScrumKnowledge(?bool $scrumKnowledge): static
    {
        $this->scrumKnowledge = $scrumKnowledge;

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
