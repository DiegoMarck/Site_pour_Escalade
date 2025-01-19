<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\MediaRepository;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation\Uploadable;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MediaRepository::class)]
#[Vich\Uploadable]
class Media
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Site::class, inversedBy: 'media')]
    private ?Site $site = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $image = null;

    #[Vich\UploadableField(mapping: 'sites', fileNameProperty: 'image')]
    private ?File $imageFile = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $maj = null;

    #[ORM\ManyToOne(targetEntity: Topo::class, inversedBy: 'media')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Topo $topo = null;

    #[ORM\ManyToOne(targetEntity: Entrainement::class, inversedBy: 'media2')]
    private ?Entrainement $entrainement = null;

    #[ORM\ManyToOne(targetEntity: Site::class, inversedBy: 'photos')]
    private ?Site $photoSite = null;

    #[ORM\ManyToOne(targetEntity: Carousel::class)]
    #[ORM\JoinColumn(nullable: true)]
    private ?Carousel $carousel = null;

    public function __toString()
    {
        if (is_null($this->nom)) {
            return 'NULL';
        }
        return $this->nom;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSite(): ?Site
    {
        return $this->site;
    }

    public function setSite(?Site $site): self
    {
        $this->site = $site;
        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;
        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            $this->maj = new \DateTimeImmutable();
        }
    }

    public function getMaj(): ?\DateTimeInterface
    {
        return $this->maj;
    }

    public function setMaj(?\DateTimeInterface $maj): self
    {
        $this->maj = $maj;
        return $this;
    }

    public function getTopo(): ?Topo
    {
        return $this->topo;
    }

    public function setTopo(?Topo $topo): self
    {
        $this->topo = $topo;
        return $this;
    }

    public function getEntrainement(): ?Entrainement
    {
        return $this->entrainement;
    }

    public function setEntrainement(?Entrainement $entrainement): self
    {
        $this->entrainement = $entrainement;
        return $this;
    }

    public function getPhotoSite(): ?Site
    {
        return $this->photoSite;
    }

    public function setPhotoSite(?Site $photoSite): self
    {
        $this->photoSite = $photoSite;
        return $this;
    }

    public function getCarousel(): ?Carousel
    {
        return $this->carousel;
    }

    public function setCarousel(?Carousel $carousel): self
    {
        $this->carousel = $carousel;
        return $this;
    }
}
