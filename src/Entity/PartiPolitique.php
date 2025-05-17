<?php

namespace App\Entity;

use App\Repository\PartiPolitiqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PartiPolitiqueRepository::class)]
class PartiPolitique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photo = null;


    #[ORM\Column(type: Types::TEXT)]
    private ?string $historique = null;

    /**
     * @var Collection<int, Mandat>
     */
    #[ORM\OneToMany(targetEntity: Mandat::class, mappedBy: 'partiPolitique')]
    private Collection $mandats;

    /**
     * @var Collection<int, AffiliationPartiPolitique>
     */
    #[ORM\OneToMany(targetEntity: AffiliationPartiPolitique::class, mappedBy: 'partiPolitique')]
    private Collection $affiliationPartiPolitiques;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $fondation = null;

    #[ORM\Column(length: 255)]
    private ?string $sigle = null;

    public function __construct()
    {
        $this->mandats = new ArrayCollection();
        $this->affiliationPartiPolitiques = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }




    public function getHistorique(): ?string
    {
        return $this->historique;
    }

    public function setHistorique(string $historique): static
    {
        $this->historique = $historique;

        return $this;
    }

    /**
     * @return Collection<int, Mandat>
     */
    public function getMandats(): Collection
    {
        return $this->mandats;
    }

    public function addMandat(Mandat $mandat): static
    {
        if (!$this->mandats->contains($mandat)) {
            $this->mandats->add($mandat);
            $mandat->setPartiPolitique($this);
        }

        return $this;
    }

    public function removeMandat(Mandat $mandat): static
    {
        if ($this->mandats->removeElement($mandat)) {
            // set the owning side to null (unless already changed)
            if ($mandat->getPartiPolitique() === $this) {
                $mandat->setPartiPolitique(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AffiliationPartiPolitique>
     */
    public function getAffiliationPartiPolitiques(): Collection
    {
        return $this->affiliationPartiPolitiques;
    }

    public function addAffiliationPartiPolitique(AffiliationPartiPolitique $affiliationPartiPolitique): static
    {
        if (!$this->affiliationPartiPolitiques->contains($affiliationPartiPolitique)) {
            $this->affiliationPartiPolitiques->add($affiliationPartiPolitique);
            $affiliationPartiPolitique->setPartiPolitique($this);
        }

        return $this;
    }

    public function removeAffiliationPartiPolitique(AffiliationPartiPolitique $affiliationPartiPolitique): static
    {
        if ($this->affiliationPartiPolitiques->removeElement($affiliationPartiPolitique)) {
            // set the owning side to null (unless already changed)
            if ($affiliationPartiPolitique->getPartiPolitique() === $this) {
                $affiliationPartiPolitique->setPartiPolitique(null);
            }
        }

        return $this;
    }

    public function getFondation(): ?\DateTimeInterface
    {
        return $this->fondation;
    }

    public function setFondation(?\DateTimeInterface $fondation): static
    {
        $this->fondation = $fondation;

        return $this;
    }

    public function getSigle(): ?string
    {
        return $this->sigle;
    }

    public function setSigle(string $sigle): static
    {
        $this->sigle = $sigle;

        return $this;
    }
}
