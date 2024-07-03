<?php

namespace App\Entity;

use App\Repository\SensationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: SensationRepository::class)]
class Sensation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('Public')]
    private ?int $id = null;

    #[ORM\Column(length: 510)]
    #[Groups('Public')]
    private ?string $content = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Feeling $feeling = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getFeeling(): ?Feeling
    {
        return $this->feeling;
    }

    public function setFeeling(?Feeling $feeling): static
    {
        $this->feeling = $feeling;

        return $this;
    }
}
