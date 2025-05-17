<?php

namespace App\Entity;

use App\Repository\CirconscriptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CirconscriptionRepository::class)]
class Circonscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    /**
     * @var Collection<int, Depute>
     */
    #[ORM\OneToMany(targetEntity: Depute::class, mappedBy: 'circonscription')]
    private Collection $deputes;

    public function __construct()
    {
        $this->deputes = new ArrayCollection();
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

    /**
     * @return Collection<int, Depute>
     */
    public function getDeputes(): Collection
    {
        return $this->deputes;
    }

    public function addDepute(Depute $depute): static
    {
        if (!$this->deputes->contains($depute)) {
            $this->deputes->add($depute);
            $depute->setCirconscription($this);
        }

        return $this;
    }

    public function removeDepute(Depute $depute): static
    {
        if ($this->deputes->removeElement($depute)) {
            // set the owning side to null (unless already changed)
            if ($depute->getCirconscription() === $this) {
                $depute->setCirconscription(null);
            }
        }

        return $this;
    }
}
