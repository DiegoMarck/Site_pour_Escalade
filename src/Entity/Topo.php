<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\TopoRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * 
 * @ORM\Entity(repositoryClass=TopoRepository::class)
 * @Vich\Uploadable
 * @ApiResource()
 */
class Topo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\ManyToMany(targetEntity=Site::class)
     */
    private $nomSite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pays;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $region;

    /**
     * @ORM\Column(type="date", nullable=true)site
     */
    private $datedeParution;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datedeMiseajour;

    /**
     * @ORM\Column(type="decimal", precision=7, scale=2, nullable=true)
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $auteur;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255 , nullable=true)
     */
    private $type;
    // /**
    //  * @ORM\Column(type="array", nullable=true)
    //  */
    // private $type = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="sites", fileNameProperty="image" )
     * 
     */
    private $imageFile;

    /**
     * @ORM\OneToMany(targetEntity=Media::class, mappedBy="topo", cascade={"persist"})
     */
    private $media;

    

    public function __construct()
    {
        $this->nomSite = new ArrayCollection();
        $this->media = new ArrayCollection();
    }
    public function __toString(){
        return $this->getTitre();
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
            // set the owning side to null (unless already changed)
            if ($medium->getTopo() === $this) {
                $medium->setTopo(null);
            }
        }

        return $this;
    }
}
