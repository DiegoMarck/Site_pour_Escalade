<?php

namespace App\Entity;

use App\Repository\EntrainementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EntrainementRepository::class)
 */
class Entrainement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $exercice;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @ORM\ManyToMany(targetEntity=Site::class, inversedBy="entrainements")
     */
    private $lieu_entrainement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $materiel;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="entrainement")
     */
    private $participant;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $media;

    /**
     * @ORM\OneToMany(targetEntity=Media::class, mappedBy="entrainement")
     */
    private $media2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $coach;

    public function __construct()
    {
        $this->lieu_entrainement = new ArrayCollection();
        $this->participant = new ArrayCollection();
        $this->media2 = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExercice(): ?string
    {
        return $this->exercice;
    }

    public function setExercice(?string $exercice): self
    {
        $this->exercice = $exercice;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Site[]
     */
    public function getLieuEntrainement(): Collection
    {
        return $this->lieu_entrainement;
    }

    public function addLieuEntrainement(Site $lieuEntrainement): self
    {
        if (!$this->lieu_entrainement->contains($lieuEntrainement)) {
            $this->lieu_entrainement[] = $lieuEntrainement;
        }

        return $this;
    }

    public function removeLieuEntrainement(Site $lieuEntrainement): self
    {
        $this->lieu_entrainement->removeElement($lieuEntrainement);

        return $this;
    }

    public function getMateriel(): ?string
    {
        return $this->materiel;
    }

    public function setMateriel(?string $materiel): self
    {
        $this->materiel = $materiel;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getParticipant(): Collection
    {
        return $this->participant;
    }

    public function addParticipant(User $participant): self
    {
        if (!$this->participant->contains($participant)) {
            $this->participant[] = $participant;
            $participant->setEntrainement($this);
        }

        return $this;
    }

    public function removeParticipant(User $participant): self
    {
        if ($this->participant->removeElement($participant)) {
            // set the owning side to null (unless already changed)
            if ($participant->getEntrainement() === $this) {
                $participant->setEntrainement(null);
            }
        }
        return $this;
    }

    public function getMedia(): ?string
    {
        return $this->media;
    }

    public function setMedia(?string $media): self
    {
        $this->media = $media;

        return $this;
    }

    /**
     * @return Collection|media[]
     */
    public function getMedia2(): Collection
    {
        return $this->media2;
    }

    public function addMedia2(media $media2): self
    {
        if (!$this->media2->contains($media2)) {
            $this->media2[] = $media2;
            $media2->setEntrainement($this);
        }

        return $this;
    }

    public function removeMedia2(media $media2): self
    {
        if ($this->media2->removeElement($media2)) {
            // set the owning side to null (unless already changed)
            if ($media2->getEntrainement() === $this) {
                $media2->setEntrainement(null);
            }
        }

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCoach(): ?string
    {
        return $this->coach;
    }

    public function setCoach(?string $coach): self
    {
        $this->coach = $coach;

        return $this;
    }
}
