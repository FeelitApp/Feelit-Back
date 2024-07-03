<?php

namespace App\Entity;

use App\Repository\FeelingRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: FeelingRepository::class)]
class Feeling
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('Public')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups('Public')]
    private ?string $category = null;

    #[ORM\Column(length: 255)]
    #[Groups('Public')]
    private ?string $emoji = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getEmoji(): ?string
    {
        return $this->emoji;
    }

    public function setEmoji(string $emoji): static
    {
        $this->emoji = $emoji;

        return $this;
    }
}
