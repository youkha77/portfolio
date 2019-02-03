<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GalleryRepository")
 *  @Vich\Uploadable
 */
class Gallery
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @var File
     * @Vich\UploadableField(mapping="product_image_presentation", fileNameProperty="filename")
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $filename;



    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Articles", inversedBy="gallerie")
     */
    private $articles;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Blog", inversedBy="gallerie")
     */
    private $blog;


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

    public function getAlt(): ?string
    {
        return $this->alt;
    }

    public function setAlt(string $alt): self
    {
        $this->alt = $alt;

        return $this;
    }


    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(?string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }




 /**
     * @return File|null
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @param File $imageFile
     * @throws \Exception
     */
    public function setImageFile(File $imageFile = null): void
    {
        $this->imageFile = $imageFile;
        if(!is_null($imageFile)) {
            // on provoque l'upload
            $this->creatAt = new \DateTimeImmutable();
        }
    }








    public function getArticles(): ?Articles
    {
        return $this->articles;
    }

    public function setArticles(?Articles $articles): self
    {
        $this->articles = $articles;

        return $this;
    }

    public function getBlog(): ?Blog
    {
        return $this->blog;
    }

    public function setBlog(?Blog $blog): self
    {
        $this->blog = $blog;

        return $this;
    }






}
