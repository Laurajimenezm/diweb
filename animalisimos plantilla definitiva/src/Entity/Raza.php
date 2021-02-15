<?php

namespace App\Entity;

use App\Repository\RazaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=RazaRepository::class)
 */
class Raza
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="El campo nombre no puede estar vacio")
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @Assert\NotBlank(message="El campo nombre no puede estar vacio")
     * @ORM\ManyToOne(targetEntity=Gatoperro::class, inversedBy="razas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $gatoperro;

    /**
     * @ORM\OneToMany(targetEntity=Animal::class, mappedBy="raza", orphanRemoval=true)
     */
    private $animals;

    public function __construct()
    {
        $this->animals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getGatoperro(): ?Gatoperro
    {
        return $this->gatoperro;
    }

    public function setGatoperro(?Gatoperro $gatoperro): self
    {
        $this->gatoperro = $gatoperro;

        return $this;
    }

    /**
     * @return Collection|Animal[]
     */
    public function getAnimals(): Collection
    {
        return $this->animals;
    }

    public function addAnimal(Animal $animal): self
    {
        if (!$this->animals->contains($animal)) {
            $this->animals[] = $animal;
            $animal->setRaza($this);
        }

        return $this;
    }

    public function removeAnimal(Animal $animal): self
    {
        if ($this->animals->removeElement($animal)) {
            // set the owning side to null (unless already changed)
            if ($animal->getRaza() === $this) {
                $animal->setRaza(null);
            }
        }

        return $this;
    }

       /**
     * Generates the magic method
     * 
     */
    public function __toString(){
        // to show the name of the Category in the select
        return $this->nombre;
        // to show the id of the Category in the select
        // return $this->id;
    }
}
