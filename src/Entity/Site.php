<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\SiteRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * 
 * @ORM\Entity(repositoryClass=SiteRepository::class)
 * @Vich\Uploadable
 * @ApiResource()
 */
class Site
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Your first name must be at least 2 characters long",
     *      maxMessage = "Your first name cannot be longer than 50 characters")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $grandeVilleProche;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $villeLaPlusProche;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $exposition = [];

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $altitudeAuxPiedsdesVoies;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dureeMarcheAproche;

    // /**
    //  * @ORM\Column(type="array", nullable=true)
    //  */
    // private $profilMarcheApproche = [];
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $profilMarcheApproche;

    // /**
    //  * @ORM\Column(type="array", nullable=true)
    //  */
    // private $practicabiitePiedsdesVoies = [];
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private  $practicabiitePiedsdesVoies ;

    /**
     * @ORM\Column(type="decimal", precision=20, scale=16)
     */
    private $latitude;

    /**
     * @ORM\Column(type="decimal", precision=20, scale=16)
     */
    private $longitude;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nombreFalaise;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $hauteurMax;

    /**
     * @ORM\Column(type="array")
     */
    private $typeEscalade = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $typeEquipement = [];

    // /**
    //  * @ORM\Column(type="array", nullable=true)
    //  */
    // private $nombredeVoie = [];
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nombredeVoie;

    // /**
    //  * @ORM\Column(type="array")
    //  */
    // private $difficulte = [];
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $difficulte;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $difficulte2;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $siteInteressantpourGrimpeur = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $typeRocher = [];

    //  /**
    //  * @ORM\Column(type="string", length=255, nullable=true)
    //  */
    // private $typeRocher;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $profileFalaise = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $typedePrise = [];

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $restriction;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $infoSuplementaire;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $siteInternet;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $voieMythique;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nomprenompseudo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresseMail;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $meilleurperiode = [];

    /**
     * @ORM\OneToMany(targetEntity=Media::class, mappedBy="site", cascade={"persist"})
     */
    private $media;

    /**
     * @ORM\ManyToMany(targetEntity=Entrainement::class, mappedBy="lieu_entrainement")
     */
    private $entrainements;

    /**
     * @ORM\OneToMany(targetEntity=Media::class, mappedBy="photoSite")
     */
    private $photos;
    
    //cascade->upload multiple donc plus besoin des 2 suivant
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $images;

    /**
     * @Vich\UploadableField(mapping="sites", fileNameProperty="images" )
     * 
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    public function __construct()
    {
        $this->media = new ArrayCollection();
        $this->entrainements = new ArrayCollection();
        $this->photos = new ArrayCollection();
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    public function __toString(){
        // return $this->getMedia;
        return $this->getNom();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getGrandeVilleProche(): ?string
    {
        return $this->grandeVilleProche;
    }

    public function setGrandeVilleProche(?string $grandeVilleProche): self
    {
        $this->grandeVilleProche = $grandeVilleProche;

        return $this;
    }

    public function getVilleLaPlusProche(): ?string
    {
        return $this->villeLaPlusProche;
    }

    public function setVilleLaPlusProche(?string $villeLaPlusProche): self
    {
        $this->villeLaPlusProche = $villeLaPlusProche;

        return $this;
    }

    public function getExposition(): ?array
    {
        return $this->exposition;
    }

    public function setExposition(?array $exposition): self
    {
        $this->exposition = $exposition;

        return $this;
    }

    public function getAltitudeAuxPiedsdesVoies(): ?int
    {
        return $this->altitudeAuxPiedsdesVoies;
    }

    public function setAltitudeAuxPiedsdesVoies(?int $altitudeAuxPiedsdesVoies): self
    {
        $this->altitudeAuxPiedsdesVoies = $altitudeAuxPiedsdesVoies;

        return $this;
    }

    public function getDureeMarcheAproche(): ?int
    {
        return $this->dureeMarcheAproche;
    }

    public function setDureeMarcheAproche(?int $dureeMarcheAproche): self
    {
        $this->dureeMarcheAproche = $dureeMarcheAproche;

        return $this;
    }

    // public function getProfilMarcheApproche(): ?array
    // {
    //     return $this->profilMarcheApproche;
    // }

    // public function setProfilMarcheApproche(?array $profilMarcheApproche): self
    // {
    //     $this->profilMarcheApproche = $profilMarcheApproche;

    //     return $this;
    // }
    public function getProfilMarcheApproche(): ?string
    {
        return $this->profilMarcheApproche;
    }

    public function setProfilMarcheApproche(?string $profilMarcheApproche): self
    {
        $this->profilMarcheApproche = $profilMarcheApproche;

        return $this;
    }

    public function getPracticabiitePiedsdesVoies(): ?string
    {
        return $this->practicabiitePiedsdesVoies;
    }

    public function setPracticabiitePiedsdesVoies(?string $practicabiitePiedsdesVoies): self
    {
        $this->practicabiitePiedsdesVoies = $practicabiitePiedsdesVoies;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getNombreFalaise(): ?int
    {
        return $this->nombreFalaise;
    }

    public function setNombreFalaise(?int $nombreFalaise): self
    {
        $this->nombreFalaise = $nombreFalaise;

        return $this;
    }

    public function getHauteurMax(): ?int
    {
        return $this->hauteurMax;
    }

    public function setHauteurMax(?int $hauteurMax): self
    {
        $this->hauteurMax = $hauteurMax;

        return $this;
    }

    public function getTypeEscalade(): ?array
    {
        return $this->typeEscalade;
    }

    public function setTypeEscalade(array $typeEscalade): self
    {
        $this->typeEscalade = $typeEscalade;

        return $this;
    }

    public function getTypeEquipement(): ?array
    {
        return $this->typeEquipement;
    }

    public function setTypeEquipement(?array $typeEquipement): self
    {
        $this->typeEquipement = $typeEquipement;

        return $this;
    }

    // public function getNombredeVoie(): ?array
    // {
    //     return $this->nombredeVoie;
    // }

    // public function setNombredeVoie(?array $nombredeVoie): self
    // {
    //     $this->nombredeVoie = $nombredeVoie;

    //     return $this;
    // }

    public function getNombredeVoie(): ?string
    {
        return $this->nombredeVoie;
    }

    public function setNombredeVoie(?string $nombredeVoie): self
    {
        $this->nombredeVoie = $nombredeVoie;

        return $this;
    }


    public function getDifficulte(): ?string
    {
        return $this->difficulte;
    }

    public function setDifficulte(?string $difficulte): self
    {
        $this->difficulte = $difficulte;

        return $this;
    }

    public function getDifficulte2(): ?string
    {
        return $this->difficulte2;
    }

    public function setDifficulte2(string $difficulte2): self
    {
        $this->difficulte2 = $difficulte2;

        return $this;
    }

    public function getSiteInteressantpourGrimpeur(): ?array
    {
        return $this->siteInteressantpourGrimpeur;
    }

    public function setSiteInteressantpourGrimpeur(?array $siteInteressantpourGrimpeur): self
    {
        $this->siteInteressantpourGrimpeur = $siteInteressantpourGrimpeur;

        return $this;
    }

    public function getTypeRocher(): ?array
    {
        return $this->typeRocher;
    }

    public function setTypeRocher(?array $typeRocher): self
    {
        $this->typeRocher = $typeRocher;

        return $this;
    }

    // public function getTypeRocher(): ?string
    // {
    //     return $this->typeRocher;
    // }

    // public function setTypeRocher(?string $typeRocher): self
    // {
    //     $this->typeRocher = $typeRocher;

    //     return $this;
    // }

    public function getProfileFalaise(): ?array
    {
        return $this->profileFalaise;
    }

    public function setProfileFalaise(?array $profileFalaise): self
    {
        $this->profileFalaise = $profileFalaise;

        return $this;
    }

    public function getTypedePrise(): ?array
    {
        return $this->typedePrise;
    }

    public function setTypedePrise(?array $typedePrise): self
    {
        $this->typedePrise = $typedePrise;

        return $this;
    }

    public function getRestriction(): ?string
    {
        return $this->restriction;
    }

    public function setRestriction(?string $restriction): self
    {
        $this->restriction = $restriction;

        return $this;
    }

    public function getInfoSuplementaire(): ?string
    {
        return $this->infoSuplementaire;
    }

    public function setInfoSuplementaire(?string $infoSuplementaire): self
    {
        $this->infoSuplementaire = $infoSuplementaire;

        return $this;
    }

    public function getSiteInternet(): ?string
    {
        return $this->siteInternet;
    }

    public function setSiteInternet(?string $siteInternet): self
    {
        $this->siteInternet = $siteInternet;

        return $this;
    }

    public function getVoieMythique(): ?string
    {
        return $this->voieMythique;
    }

    public function setVoieMythique(?string $voieMythique): self
    {
        $this->voieMythique = $voieMythique;

        return $this;
    }

    public function getNomprenompseudo(): ?string
    {
        return $this->nomprenompseudo;
    }

    public function setNomprenompseudo(?string $nomprenompseudo): self
    {
        $this->nomprenompseudo = $nomprenompseudo;

        return $this;
    }

    public function getAdresseMail(): ?string
    {
        return $this->adresseMail;
    }

    public function setAdresseMail(?string $adresseMail): self
    {
        $this->adresseMail = $adresseMail;

        return $this;
    }

    public function getMeilleurperiode(): ?array
    {
        return $this->meilleurperiode;
    }

    public function setMeilleurperiode(?array $meilleurperiode): self
    {
        $this->meilleurperiode = $meilleurperiode;

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
            $medium->setSite($this);
        }

        return $this;
    }

    public function removeMedium(Media $medium): self
    {
        if ($this->media->removeElement($medium)) {
            // set the owning side to null (unless already changed)
            if ($medium->getSite() === $this) {
                $medium->setSite(null);
            }
        }

        return $this;
    }

    public function getImages(): ?string
    {
        return $this->images;
    }
    
    public function setImages(?string $images): self
    {
        $this->images = $images;

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
            $this->updatedAt = new \DateTime();

        }
        return $this;
    }

    /**
     * @return Collection|Entrainement[]
     */
    public function getEntrainements(): Collection
    {
        return $this->entrainements;
    }

    public function addEntrainement(Entrainement $entrainement): self
    {
        if (!$this->entrainements->contains($entrainement)) {
            $this->entrainements[] = $entrainement;
            $entrainement->addLieuEntrainement($this);
        }

        return $this;
    }

    public function removeEntrainement(Entrainement $entrainement): self
    {
        if ($this->entrainements->removeElement($entrainement)) {
            $entrainement->removeLieuEntrainement($this);
        }

        return $this;
    }

    /**
     * @return Collection|Media[]
     */
    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(Media $photo): self
    {
        if (!$this->photos->contains($photo)) {
            $this->photos[] = $photo;
            $photo->setPhotoSite($this);
        }

        return $this;
    }

    public function removePhoto(Media $photo): self
    {
        if ($this->photos->removeElement($photo)) {
            // set the owning side to null (unless already changed)
            if ($photo->getPhotoSite() === $this) {
                $photo->setPhotoSite(null);
            }
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    
}
