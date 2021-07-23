<?php

namespace App\Entity;

use App\Repository\VoieRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VoieRepository::class)
 */
class Voie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $hauteur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $equipeur;

    /**
     * @ORM\ManyToOne(targetEntity=Site::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $nom;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHauteur(): ?int
    {
        return $this->hauteur;
    }

    public function setHauteur(?int $hauteur): self
    {
        $this->hauteur = $hauteur;

        return $this;
    }

    public function getEquipeur(): ?string
    {
        return $this->equipeur;
    }

    public function setEquipeur(?string $equipeur): self
    {
        $this->equipeur = $equipeur;

        return $this;
    }

    public function getNom(): ?Site
    {
        return $this->nom;
    }

    public function setNom(?Site $nom): self
    {
        $this->nom = $nom;

        return $this;
    }
}
