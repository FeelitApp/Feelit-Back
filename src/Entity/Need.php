<?php

namespace App\Entity;

use App\Repository\NeedRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NeedRepository::class)]
class Need
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 510)]
    private ?string $content = null;

    #[ORM\ManyToMany(targetEntity: feeling::class, inversedBy: 'needs')]
    private Collection $id_feeling;

    #[ORM\Column(length: 510)]
    private ?string $picture = null;

    public function __construct()
    {
        $this->id_feeling = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, feeling>
     */
    public function getIdFeeling(): Collection
    {
        return $this->id_feeling;
    }

    public function addIdFeeling(feeling $idFeeling): static
    {
        if (!$this->id_feeling->contains($idFeeling)) {
            $this->id_feeling->add($idFeeling);
        }

        return $this;
    }

    public function removeIdFeeling(feeling $idFeeling): static
    {
        $this->id_feeling->removeElement($idFeeling);

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): static
    {
        $this->picture = $picture;

        return $this;
    }
}
