<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\TopoRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: TopoRepository::class)]
#[Vich\Uploadable]
#[ApiResource]
class Topo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $titre = null;

    #[ORM\ManyToMany(targetEntity: Site::class)]
    private Collection $nomSite;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $pays = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $region = null;

    #[ORM\Column(type: 'date', nullable: true)]
    private ?\DateTimeInterface $datedeParution = null;

    #[ORM\Column(type: 'date', nullable: true)]
    private ?\DateTimeInterface $datedeMiseajour = null;

    #[ORM\Column(type: 'decimal', precision: 7, scale: 2, nullable: true)]
    private ?string $prix = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $auteur = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $type = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $image = null;

    #[Vich\UploadableField(mapping: "sites", fileNameProperty: "image")]
    private $imageFile;

    #[ORM\OneToMany(mappedBy: 'topo', targetEntity: Media::class, cascade: ['persist'])]
    private Collection $media;

    public function __construct()
    {
        $this->nomSite = new ArrayCollection();
        $this->media = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;
        return $this;
    }

    /**
     * @return Collection|Site[]
     */
    public function getNomSite(): Collection
    {
        return $this->nomSite;
    }

    public function addNomSite(Site $nomSite): self
    {
        if (!$this->nomSite->contains($nomSite)) {
            $this->nomSite[] = $nomSite;
        }
        return $this;
    }

    public function removeNomSite(Site $nomSite): self
    {
        $this->nomSite->removeElement($nomSite);
        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;
        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(?string $region): self
    {
        $this->region = $region;
        return $this;
    }

    public function getDatedeParution(): ?\DateTimeInterface
    {
        return $this->datedeParution;
    }

    public function setDatedeParution(?\DateTimeInterface $datedeParution): self
    {
        $this->datedeParution = $datedeParution;
        return $this;
    }

    public function getDatedeMiseajour(): ?\DateTimeInterface
    {
        return $this->datedeMiseajour;
    }

    public function setDatedeMiseajour(?\DateTimeInterface $datedeMiseajour): self
    {
        $this->datedeMiseajour = $datedeMiseajour;
        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(?string $prix): self
    {
        $this->prix = $prix;
        return $this;
    }

    public function getAuteur(): ?string
    {
        return $this->auteur;
    }

    public function setAuteur(?string $auteur): self
    {
        $this->auteur = $auteur;
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;
        return $this;
    }

    /**
     * Get the value of imageFile
     */ 
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * Set the value of imageFile
     *
     * @return  self
     */ 
    public function setImageFile(File $file)
    {
        $this->imageFile = $file;
        if($file !== null){
            $this->datedeMiseajour = new \DateTime();

        }
        return $this;
    }

    /**
     * @return Collection|Media[]
     */
    public function getMedia(): Collection
    {
        return $this->media;
    }

    public function addMedium(Media $medium): self
    {
        if (!$this->media->contains($medium)) {
            $this->media[] = $medium;
            $medium->setTopo($this);
        }
        return $this;
    }

    public function removeMedium(Media $medium): self
    {
        if ($this->media->removeElement($medium)) {
            if ($medium->getTopo() === $this) {
                $medium->setTopo(null);
            }
        }
        return $this;
    }
}
