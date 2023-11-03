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
    #[Groups("sensations")]
    private ?int $id = null;

    #[ORM\Column(length: 510)]
    #[Groups("sensations")]
    private ?string $content = null;

    #[ORM\ManyToOne(inversedBy: 'sensations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?feeling $id_feeling = null;

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

    public function getIdFeeling(): ?feeling
    {
        return $this->id_feeling;
    }

    public function setIdFeeling(?feeling $id_feeling): static
    {
        $this->id_feeling = $id_feeling;

        return $this;
    }
}
