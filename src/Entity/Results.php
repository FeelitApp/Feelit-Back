<?php

namespace App\Entity;

use App\Repository\ResultsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResultsRepository::class)]
class Results
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Sensation $sensation_id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Feeling $feeling_id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Emotion $emotion_id = null;

    #[ORM\Column(length: 1312, nullable: true)]
    private ?string $note = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getSensationId(): ?Sensation
    {
        return $this->sensation_id;
    }

    public function setSensationId(?Sensation $sensation_id): static
    {
        $this->sensation_id = $sensation_id;

        return $this;
    }

    public function getFeelingId(): ?Feeling
    {
        return $this->feeling_id;
    }

    public function setFeelingId(?Feeling $feeling_id): static
    {
        $this->feeling_id = $feeling_id;

        return $this;
    }

    public function getEmotionId(): ?Emotion
    {
        return $this->emotion_id;
    }

    public function setEmotionId(?Emotion $emotion_id): static
    {
        $this->emotion_id = $emotion_id;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): static
    {
        $this->note = $note;

        return $this;
    }
}
