<?php

namespace App\Entity;

use App\Repository\LegislatureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LegislatureRepository::class)]
class Legislature
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateFin = null;

    /**
     * @var Collection<int, Mandat>
     */
    #[ORM\OneToMany(targetEntity: Mandat::class, mappedBy: 'legislature')]
    private Collection $mandats;

    /**
     * @var Collection<int, GroupeParlementaire>
     */
    #[ORM\OneToMany(targetEntity: GroupeParlementaire::class, mappedBy: 'legislature')]
    private Collection $groupeParlementaires;

    public function __construct()
    {
        $this->mandats = new ArrayCollection();
        $this->groupeParlementaires = new ArrayCollection();
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

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): static
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(?\DateTimeInterface $dateFin): static
    {
        $this->dateFin = $dateFin;

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
            $mandat->setLegislature($this);
        }

        return $this;
    }

    public function removeMandat(Mandat $mandat): static
    {
        if ($this->mandats->removeElement($mandat)) {
            // set the owning side to null (unless already changed)
            if ($mandat->getLegislature() === $this) {
                $mandat->setLegislature(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, GroupeParlementaire>
     */
    public function getGroupeParlementaires(): Collection
    {
        return $this->groupeParlementaires;
    }

    public function addGroupeParlementaire(GroupeParlementaire $groupeParlementaire): static
    {
        if (!$this->groupeParlementaires->contains($groupeParlementaire)) {
            $this->groupeParlementaires->add($groupeParlementaire);
            $groupeParlementaire->setLegislature($this);
        }

        return $this;
    }

    public function removeGroupeParlementaire(GroupeParlementaire $groupeParlementaire): static
    {
        if ($this->groupeParlementaires->removeElement($groupeParlementaire)) {
            // set the owning side to null (unless already changed)
            if ($groupeParlementaire->getLegislature() === $this) {
                $groupeParlementaire->setLegislature(null);
            }
        }

        return $this;
    }
}
