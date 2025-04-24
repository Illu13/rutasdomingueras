<?php

namespace App\Entity;

use App\Repository\FotoRutaRepository;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

#[ORM\Entity(repositoryClass: FotoRutaRepository::class)]
#[Vich\Uploadable]
class FotoRuta
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $ImageName = null;

    #[ORM\Column(length: 400)]
    private ?string $descripcionFoto = null;

    #[ORM\ManyToOne(inversedBy: 'fotoRutas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ruta $idRuta = null;

    #[Vich\UploadableField(mapping: 'rutaFoto', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;


    public function setImageFile(?File $imageFile = null): static
    {
        $this->imageFile = $imageFile;

        if ($imageFile) {
            // Actualiza la fecha para forzar la re-carga en Doctrine
            $this->updatedAt = new \DateTimeImmutable();
        }

        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImageName(): ?string
    {
        return $this->ImageName;
    }

    public function setImageName(string $ImageName): static
    {
        $this->ImageName = $ImageName;

        return $this;
    }

    public function getDescripcionFoto(): ?string
    {
        return $this->descripcionFoto;
    }

    public function setDescripcionFoto(string $descripcionFoto): static
    {
        $this->descripcionFoto = $descripcionFoto;

        return $this;
    }

    public function getIdRuta(): ?Ruta
    {
        return $this->idRuta;
    }

    public function setIdRuta(?Ruta $idRuta): static
    {
        $this->idRuta = $idRuta;

        return $this;
    }
}
