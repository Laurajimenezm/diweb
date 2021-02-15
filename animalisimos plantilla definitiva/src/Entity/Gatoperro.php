<?php

namespace App\Entity;

use App\Repository\GatoperroRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=GatoperroRepository::class)
 */
class Gatoperro
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
     * @ORM\OneToMany(targetEntity=Raza::class, mappedBy="gatoperro", orphanRemoval=true)
     */
    private $razas;

    public function __construct()
    {
        $this->razas = new ArrayCollection();
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

    /**
     * @return Collection|Raza[]
     */
    public function getRazas(): Collection
    {
        return $this->razas;
    }

    public function addRaza(Raza $raza): self
    {
        if (!$this->razas->contains($raza)) {
            $this->razas[] = $raza;
            $raza->setGatoperro($this);
        }

        return $this;
    }

    public function removeRaza(Raza $raza): self
    {
        if ($this->razas->removeElement($raza)) {
            // set the owning side to null (unless already changed)
            if ($raza->getGatoperro() === $this) {
                $raza->setGatoperro(null);
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
