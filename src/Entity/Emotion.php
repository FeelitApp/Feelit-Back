<?php

namespace App\Entity;

use App\Repository\EmotionRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmotionRepository::class)]
class Emotion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups("emotions")]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups("emotions")]
    private ?string $content = null;

    #[ORM\ManyToOne(inversedBy: 'emotions')]
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
