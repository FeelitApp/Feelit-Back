<?php

namespace App\Entity;

use App\Repository\EntryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntryRepository::class)]
class Entry
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'Entries')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Sensation $sensation = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Feeling $feeling = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Emotion $emotion = null;

    #[ORM\ManyToMany(targetEntity: Need::class)]
    private Collection $need;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $comment = null;

    public function __construct()
    {
        $this->need = new ArrayCollection();
        $this->created_at = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getSensation(): ?Sensation
    {
        return $this->sensation;
    }

    public function setSensation(?Sensation $sensation): static
    {
        $this->sensation = $sensation;

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

    public function getEmotion(): ?Emotion
    {
        return $this->emotion;
    }

    public function setEmotion(?Emotion $emotion): static
    {
        $this->emotion = $emotion;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): static
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * @return Collection<int, need>
     */
    public function getNeed(): Collection
    {
        return $this->need;
    }

    public function addNeed(Need $need): static
    {
        if (!$this->need->contains($need)) {
            $this->need->add($need);
        }

        return $this;
    }

    public function removeNeed(Need $need): static
    {
        $this->need->removeElement($need);

        return $this;
    }
}
