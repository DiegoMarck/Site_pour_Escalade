<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\MediaRepository;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation\Uploadable;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * @ORM\Entity(repositoryClass=MediaRepository::class)
 * @Vich\Uploadable
 */
class Media
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Site::class, inversedBy="media")
     */
    private $site;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

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
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $maj;

    /**
     * @ORM\ManyToOne(targetEntity=Topo::class, inversedBy="media")
     * @ORM\JoinColumn(nullable=false)
     */
    private $topo;

    /**
     * @ORM\ManyToOne(targetEntity=Entrainement::class, inversedBy="media2")
     */
    private $entrainement;

    /**
     * @ORM\ManyToOne(targetEntity=Site::class, inversedBy="photos")
     */
    private $photoSite;

    // public function __toString(){
    //     return $this->nom;
    // }
    public function __toString() {
        if(is_null($this->nom)) {
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
    public function setImageFile($imageFile)
    {
        $this->imageFile = $imageFile;
        if($imageFile !== null){
            $this->maj = new \DateTime('now');

        }
        return $this;
        return $this;
    }

    /**
     * Get the value of maj
     */ 
    public function getMaj()
    {
        return $this->maj;
    }

    /**
     * Set the value of maj
     *
     * @return  self
     */ 
    public function setMaj($maj)
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
}
