<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticlesRepository")
 */
class Articles
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;


    /**
     * @ORM\Column(type="string", length=1500)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateVoyage;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Image", cascade={"persist", "remove"})
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Gallery", mappedBy="articles", cascade={"persist"}))
     */
    private $gallerie;
    
    private $gallerieFile;

    public function __construct()
    {
        $this->gallerie = new ArrayCollection();
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }


    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDateVoyage(): ?\DateTimeInterface
    {
        return $this->dateVoyage;
    }

    public function setDateVoyage(\DateTimeInterface $dateVoyage): self
    {
        $this->dateVoyage = $dateVoyage;

        return $this;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->dateVoyage;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(?Image $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|Gallery[]
     */
    public function getGallerie(): Collection
    {
        return $this->gallerie;
    }

    public function addGallerie(Gallery $gallerie): self
    {
        if (!$this->gallerie->contains($gallerie)) {
            $this->gallerie[] = $gallerie;
            $gallerie->setArticles($this);
        }

        return $this;
    }

    public function removeGallerie(Gallery $gallerie): self
    {
        if ($this->gallerie->contains($gallerie)) {
            $this->gallerie->removeElement($gallerie);
            // set the owning side to null (unless already changed)
            if ($gallerie->getArticles() === $this) {
                $gallerie->setArticles(null);
            }
        }

        return $this;
    }


    /**
     * @return mixed
     */
    public function getGallerieFile()
    {
        return $this->gallerieFile;
    }

  
    public function setgallerieFile($gallerieFile): self
    {
        foreach($gallerieFile as $gallerieFile) {
            $gallerie = new Gallery();
            $gallerie->setImageFile($gallerieFile);
            $this->addGallerie($gallerie);
        }
        $this->gallerieFile = $gallerieFile;
        return $this;
    }


}
