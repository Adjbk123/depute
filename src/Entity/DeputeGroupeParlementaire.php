<?php

namespace App\Entity;

use App\Repository\DeputeGroupeParlementaireRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DeputeGroupeParlementaireRepository::class)]
class DeputeGroupeParlementaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'deputeGroupeParlementaires')]
    private ?Depute $depute = null;

    #[ORM\ManyToOne(inversedBy: 'deputeGroupeParlementaires')]
    private ?GroupeParlementaire $groupeParlementaire = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $debutMandat = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $finMandat = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDepute(): ?Depute
    {
        return $this->depute;
    }

    public function setDepute(?Depute $depute): static
    {
        $this->depute = $depute;

        return $this;
    }

    public function getGroupeParlementaire(): ?GroupeParlementaire
    {
        return $this->groupeParlementaire;
    }

    public function setGroupeParlementaire(?GroupeParlementaire $groupeParlementaire): static
    {
        $this->groupeParlementaire = $groupeParlementaire;

        return $this;
    }

    public function getDebutMandat(): ?\DateTimeInterface
    {
        return $this->debutMandat;
    }

    public function setDebutMandat(\DateTimeInterface $debutMandat): static
    {
        $this->debutMandat = $debutMandat;

        return $this;
    }

    public function getFinMandat(): ?\DateTimeInterface
    {
        return $this->finMandat;
    }

    public function setFinMandat(?\DateTimeInterface $finMandat): static
    {
        $this->finMandat = $finMandat;

        return $this;
    }
}
