<?php

namespace App\Entity;

use App\Repository\FeelingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FeelingRepository::class)]
class Feeling
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $category = null;

    #[ORM\Column(length: 255)]
    private ?string $emoji = null;

    #[ORM\OneToMany(mappedBy: 'id_feeling', targetEntity: Sensation::class)]
    private Collection $sensations;

    #[ORM\ManyToMany(targetEntity: Need::class, mappedBy: 'id_feeling')]
    private Collection $needs;

    #[ORM\OneToMany(mappedBy: 'id_feeling', targetEntity: Emotion::class)]
    private Collection $emotions;

    public function __construct()
    {
        $this->sensations = new ArrayCollection();
        $this->needs = new ArrayCollection();
        $this->emotions = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Sensation>
     */
    public function getSensations(): Collection
    {
        return $this->sensations;
    }

    public function addSensation(Sensation $sensation): static
    {
        if (!$this->sensations->contains($sensation)) {
            $this->sensations->add($sensation);
            $sensation->setIdFeeling($this);
        }

        return $this;
    }

    public function removeSensation(Sensation $sensation): static
    {
        if ($this->sensations->removeElement($sensation)) {
            // set the owning side to null (unless already changed)
            if ($sensation->getIdFeeling() === $this) {
                $sensation->setIdFeeling(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Need>
     */
    public function getNeeds(): Collection
    {
        return $this->needs;
    }

    public function addNeed(Need $need): static
    {
        if (!$this->needs->contains($need)) {
            $this->needs->add($need);
            $need->addIdFeeling($this);
        }

        return $this;
    }

    public function removeNeed(Need $need): static
    {
        if ($this->needs->removeElement($need)) {
            $need->removeIdFeeling($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Emotion>
     */
    public function getEmotions(): Collection
    {
        return $this->emotions;
    }

    public function addEmotion(Emotion $emotion): static
    {
        if (!$this->emotions->contains($emotion)) {
            $this->emotions->add($emotion);
            $emotion->setIdFeeling($this);
        }

        return $this;
    }

    public function removeEmotion(Emotion $emotion): static
    {
        if ($this->emotions->removeElement($emotion)) {
            // set the owning side to null (unless already changed)
            if ($emotion->getIdFeeling() === $this) {
                $emotion->setIdFeeling(null);
            }
        }

        return $this;
    }
}
