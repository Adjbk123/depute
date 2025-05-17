<?php

namespace App\Entity;

use App\Repository\AffiliationPartiPolitiqueRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AffiliationPartiPolitiqueRepository::class)]
class AffiliationPartiPolitique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'affiliationPartiPolitiques')]
    private ?Depute $depute = null;

    #[ORM\ManyToOne(inversedBy: 'affiliationPartiPolitiques')]
    private ?PartiPolitique $partiPolitique = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateAffiliation = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateFinAffiliation = null;

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

    public function getPartiPolitique(): ?PartiPolitique
    {
        return $this->partiPolitique;
    }

    public function setPartiPolitique(?PartiPolitique $partiPolitique): static
    {
        $this->partiPolitique = $partiPolitique;

        return $this;
    }

    public function getDateAffiliation(): ?\DateTimeInterface
    {
        return $this->dateAffiliation;
    }

    public function setDateAffiliation(\DateTimeInterface $dateAffiliation): static
    {
        $this->dateAffiliation = $dateAffiliation;

        return $this;
    }

    public function getDateFinAffiliation(): ?\DateTimeInterface
    {
        return $this->dateFinAffiliation;
    }

    public function setDateFinAffiliation(?\DateTimeInterface $dateFinAffiliation): static
    {
        $this->dateFinAffiliation = $dateFinAffiliation;

        return $this;
    }
}
