<?php

namespace App\Entity;

use App\Repository\DeputeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DeputeRepository::class)]
class Depute
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenoms = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateNaissance = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lieuNaissance = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $profession = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $biographie = null;

    #[ORM\ManyToOne(inversedBy: 'deputes')]
    private ?Circonscription $circonscription = null;

    /**
     * @var Collection<int, Mandat>
     */
    #[ORM\OneToMany(targetEntity: Mandat::class, mappedBy: 'depute')]
    private Collection $mandats;

    /**
     * @var Collection<int, DeputeGroupeParlementaire>
     */
    #[ORM\OneToMany(targetEntity: DeputeGroupeParlementaire::class, mappedBy: 'depute')]
    private Collection $deputeGroupeParlementaires;

    /**
     * @var Collection<int, Suppleant>
     */
    #[ORM\OneToMany(targetEntity: Suppleant::class, mappedBy: 'depute')]
    private Collection $suppleants;

    /**
     * @var Collection<int, Biographie>
     */
    #[ORM\OneToMany(targetEntity: Biographie::class, mappedBy: 'depute')]
    private Collection $biographies;

    /**
     * @var Collection<int, AffiliationPartiPolitique>
     */
    #[ORM\OneToMany(targetEntity: AffiliationPartiPolitique::class, mappedBy: 'depute')]
    private Collection $affiliationPartiPolitiques;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $genre = null;

    public function __construct()
    {
        $this->mandats = new ArrayCollection();
        $this->deputeGroupeParlementaires = new ArrayCollection();
        $this->suppleants = new ArrayCollection();
        $this->biographies = new ArrayCollection();
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

    public function getPrenoms(): ?string
    {
        return $this->prenoms;
    }

    public function setPrenoms(string $prenoms): static
    {
        $this->prenoms = $prenoms;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(?\DateTimeInterface $dateNaissance): static
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getLieuNaissance(): ?string
    {
        return $this->lieuNaissance;
    }

    public function setLieuNaissance(?string $lieuNaissance): static
    {
        $this->lieuNaissance = $lieuNaissance;

        return $this;
    }

    public function getProfession(): ?string
    {
        return $this->profession;
    }

    public function setProfession(?string $profession): static
    {
        $this->profession = $profession;

        return $this;
    }

    public function getBiographie(): ?string
    {
        return $this->biographie;
    }

    public function setBiographie(?string $biographie): static
    {
        $this->biographie = $biographie;

        return $this;
    }

    public function getCirconscription(): ?Circonscription
    {
        return $this->circonscription;
    }

    public function setCirconscription(?Circonscription $circonscription): static
    {
        $this->circonscription = $circonscription;

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
            $mandat->setDepute($this);
        }

        return $this;
    }

    public function removeMandat(Mandat $mandat): static
    {
        if ($this->mandats->removeElement($mandat)) {
            // set the owning side to null (unless already changed)
            if ($mandat->getDepute() === $this) {
                $mandat->setDepute(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, DeputeGroupeParlementaire>
     */
    public function getDeputeGroupeParlementaires(): Collection
    {
        return $this->deputeGroupeParlementaires;
    }

    public function addDeputeGroupeParlementaire(DeputeGroupeParlementaire $deputeGroupeParlementaire): static
    {
        if (!$this->deputeGroupeParlementaires->contains($deputeGroupeParlementaire)) {
            $this->deputeGroupeParlementaires->add($deputeGroupeParlementaire);
            $deputeGroupeParlementaire->setDepute($this);
        }

        return $this;
    }

    public function removeDeputeGroupeParlementaire(DeputeGroupeParlementaire $deputeGroupeParlementaire): static
    {
        if ($this->deputeGroupeParlementaires->removeElement($deputeGroupeParlementaire)) {
            // set the owning side to null (unless already changed)
            if ($deputeGroupeParlementaire->getDepute() === $this) {
                $deputeGroupeParlementaire->setDepute(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Suppleant>
     */
    public function getSuppleants(): Collection
    {
        return $this->suppleants;
    }

    public function addSuppleant(Suppleant $suppleant): static
    {
        if (!$this->suppleants->contains($suppleant)) {
            $this->suppleants->add($suppleant);
            $suppleant->setDepute($this);
        }

        return $this;
    }

    public function removeSuppleant(Suppleant $suppleant): static
    {
        if ($this->suppleants->removeElement($suppleant)) {
            // set the owning side to null (unless already changed)
            if ($suppleant->getDepute() === $this) {
                $suppleant->setDepute(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Biographie>
     */
    public function getBiographies(): Collection
    {
        return $this->biographies;
    }

    public function addBiography(Biographie $biography): static
    {
        if (!$this->biographies->contains($biography)) {
            $this->biographies->add($biography);
            $biography->setDepute($this);
        }

        return $this;
    }

    public function removeBiography(Biographie $biography): static
    {
        if ($this->biographies->removeElement($biography)) {
            // set the owning side to null (unless already changed)
            if ($biography->getDepute() === $this) {
                $biography->setDepute(null);
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
            $affiliationPartiPolitique->setDepute($this);
        }

        return $this;
    }

    public function removeAffiliationPartiPolitique(AffiliationPartiPolitique $affiliationPartiPolitique): static
    {
        if ($this->affiliationPartiPolitiques->removeElement($affiliationPartiPolitique)) {
            // set the owning side to null (unless already changed)
            if ($affiliationPartiPolitique->getDepute() === $this) {
                $affiliationPartiPolitique->setDepute(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->prenoms. " ". $this->nom;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(?string $genre): static
    {
        $this->genre = $genre;

        return $this;
    }
}
