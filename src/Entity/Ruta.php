<?php

namespace App\Entity;

use App\Repository\RutaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;



#[ORM\Entity(repositoryClass: RutaRepository::class)]
#[Vich\Uploadable]
class Ruta
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255)]
    private ?string $descripcionCorta = null;

    #[ORM\Column(length: 500)]
    private ?string $descripcionLarga = null;

    #[ORM\Column(length: 255)]
    private ?string $imageName = null;
    #[Vich\UploadableField(mapping: 'ruta', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @var Collection<int, FotoRuta>
     */
    #[ORM\OneToMany(mappedBy: 'idRuta', targetEntity: FotoRuta::class, orphanRemoval: true)]
    private Collection $fotoRutas;

    public function __construct()
    {
        $this->fotoRutas = new ArrayCollection();
    }

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

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDescripcionCorta(): ?string
    {
        return $this->descripcionCorta;
    }

    public function setDescripcionCorta(string $descripcionCorta): static
    {
        $this->descripcionCorta = $descripcionCorta;

        return $this;
    }

    public function getDescripcionLarga(): ?string
    {
        return $this->descripcionLarga;
    }

    public function setDescripcionLarga(string $descripcionLarga): static
    {
        $this->descripcionLarga = $descripcionLarga;

        return $this;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(string $imageName): static
    {
        $this->imageName = $imageName;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, FotoRuta>
     */
    public function getFotoRutas(): Collection
    {
        return $this->fotoRutas;
    }

    public function addFotoRuta(FotoRuta $fotoRuta): static
    {
        if (!$this->fotoRutas->contains($fotoRuta)) {
            $this->fotoRutas->add($fotoRuta);
            $fotoRuta->setIdRuta($this);
        }

        return $this;
    }

    public function removeFotoRuta(FotoRuta $fotoRuta): static
    {
        if ($this->fotoRutas->removeElement($fotoRuta)) {
            // set the owning side to null (unless already changed)
            if ($fotoRuta->getIdRuta() === $this) {
                $fotoRuta->setIdRuta(null);
            }
        }

        return $this;
    }
}
