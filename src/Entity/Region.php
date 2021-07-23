<?php

namespace App\Entity;

use App\Repository\RegionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=RegionRepository::class)
 */
class Region
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Topo::class)
     */
    private $nom;

    public function __construct()
    {
        $this->nom = new ArrayCollection();
    }

    public function __toString(){
        return $this->nom;

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Topo[]
     */
    public function getNom(): Collection
    {
        return $this->nom;
    }

    public function addNom(Topo $nom): self
    {
        if (!$this->nom->contains($nom)) {
            $this->nom[] = $nom;
        }

        return $this;
    }

    public function removeNom(Topo $nom): self
    {
        $this->nom->removeElement($nom);

        return $this;
    }
}
