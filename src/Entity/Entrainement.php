<?php

namespace App\Entity;

use App\Repository\EntrainementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntrainementRepository::class)]
class Entrainement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $exercice = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $type = null;

    #[ORM\ManyToMany(targetEntity: Site::class, inversedBy: 'entrainements')]
    private Collection $lieu_entrainement;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $materiel = null;

    #[ORM\OneToMany(mappedBy: 'entrainement', targetEntity: User::class)]
    private Collection $participant;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $media = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $niveau = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $duree = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $heure = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $lieu = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $organisateur = null;

    #[ORM\OneToMany(mappedBy: 'entrainement', targetEntity: Media::class)]
    private Collection $media2;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $coach = null;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(?string $niveau): self
    {
        $this->niveau = $niveau;
        return $this;
    }

    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function setDuree(?string $duree): self
    {
        $this->duree = $duree;
        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;
        return $this;
    }

    public function getHeure(): ?string
    {
        return $this->heure;
    }

    public function setHeure(?string $heure): self
    {
        $this->heure = $heure;
        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(?string $lieu): self
    {
        $this->lieu = $lieu;
        return $this;
    }

    public function getOrganisateur(): ?string
    {
        return $this->organisateur;
    }

    public function setOrganisateur(?string $organisateur): self
    {
        $this->organisateur = $organisateur;
        return $this;
    }

    /**
     * @return Collection|Media[]
     */
    public function getMedia2(): Collection
    {
        return $this->media2;
    }

    public function addMedia2(Media $media2): self
    {
        if (!$this->media2->contains($media2)) {
            $this->media2[] = $media2;
            $media2->setEntrainement($this);
        }
        return $this;
    }

    public function removeMedia2(Media $media2): self
    {
        if ($this->media2->removeElement($media2)) {
            if ($media2->getEntrainement() === $this) {
                $media2->setEntrainement(null);
            }
        }
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
