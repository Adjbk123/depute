<?php

namespace App\Entity;

use App\Repository\GroupeParlementaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GroupeParlementaireRepository::class)]
class GroupeParlementaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(length: 255)]
    private ?string $chefGroupe = null;

    /**
     * @var Collection<int, Mandat>
     */
    #[ORM\OneToMany(targetEntity: Mandat::class, mappedBy: 'groupeParlementaire')]
    private Collection $mandats;

    /**
     * @var Collection<int, DeputeGroupeParlementaire>
     */
    #[ORM\OneToMany(targetEntity: DeputeGroupeParlementaire::class, mappedBy: 'groupeParlementaire')]
    private Collection $deputeGroupeParlementaires;

    #[ORM\ManyToOne(inversedBy: 'groupeParlementaires')]
    private ?Legislature $legislature = null;

    public function __construct()
    {
        $this->mandats = new ArrayCollection();
        $this->deputeGroupeParlementaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getChefGroupe(): ?string
    {
        return $this->chefGroupe;
    }

    public function setChefGroupe(string $chefGroupe): static
    {
        $this->chefGroupe = $chefGroupe;

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
            $mandat->setGroupeParlementaire($this);
        }

        return $this;
    }

    public function removeMandat(Mandat $mandat): static
    {
        if ($this->mandats->removeElement($mandat)) {
            // set the owning side to null (unless already changed)
            if ($mandat->getGroupeParlementaire() === $this) {
                $mandat->setGroupeParlementaire(null);
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
            $deputeGroupeParlementaire->setGroupeParlementaire($this);
        }

        return $this;
    }

    public function removeDeputeGroupeParlementaire(DeputeGroupeParlementaire $deputeGroupeParlementaire): static
    {
        if ($this->deputeGroupeParlementaires->removeElement($deputeGroupeParlementaire)) {
            // set the owning side to null (unless already changed)
            if ($deputeGroupeParlementaire->getGroupeParlementaire() === $this) {
                $deputeGroupeParlementaire->setGroupeParlementaire(null);
            }
        }

        return $this;
    }

    public function getLegislature(): ?Legislature
    {
        return $this->legislature;
    }

    public function setLegislature(?Legislature $legislature): static
    {
        $this->legislature = $legislature;

        return $this;
    }
}
