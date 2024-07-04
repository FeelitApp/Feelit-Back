<?php

namespace App\Entity;

use App\Repository\NeedRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: NeedRepository::class)]
class Need
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('Public')]
    private ?int $id = null;

    #[ORM\Column(length: 510)]
    #[Groups('Public')]
    private ?string $content = null;

    #[ORM\Column(length: 510)]
    #[Groups('Public')]
    private ?string $picture = null;

    #[ORM\ManyToMany(targetEntity: Feeling::class)]
    private Collection $feeling;

    public function __construct()
    {
        $this->feeling = new ArrayCollection();
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

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): static
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return Collection<int, Feeling>
     */
    public function getFeeling(): Collection
    {
        return $this->feeling;
    }

    public function addFeeling(Feeling $feeling): static
    {
        if (!$this->feeling->contains($feeling)) {
            $this->feeling->add($feeling);
        }

        return $this;
    }

    public function removeFeeling(Feeling $feeling): static
    {
        $this->feeling->removeElement($feeling);

        return $this;
    }
}
