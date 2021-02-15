<?php

namespace App\Entity;

use App\Repository\AnimalRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AnimalRepository::class)
 */
class Animal
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
     * @Assert\GreaterThanOrEqual("today")
     * @ORM\Column(type="datetime")
     */
    private $fecha_nac;

    /**
     * @Assert\NotBlank(message="El campo nombre no puede estar vacio")
     * @ORM\Column(type="string", length=255)
     */
    private $recogida;

    /**
     * @Assert\Choice(choices = {"H", "M"}, message = "Elige un género válido.")
     * @ORM\Column(type="string", length=255)
     */
    private $sexo;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="animals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $usuario;

    /**
     * @ORM\ManyToOne(targetEntity=Raza::class, inversedBy="animals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $raza;

    /**
     *  @Assert\Length(
     *                 max = 15,
     *                 maxMessage = "El chip tiene una longitud de 15 números"
     *             )
     * @ORM\Column(type="integer",unique=true)
     */
    private $chip;

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

    public function getFechaNac(): ?\DateTimeInterface
    {
        return $this->fecha_nac;
    }

    public function setFechaNac(\DateTimeInterface $fecha_nac): self
    {
        $this->fecha_nac = $fecha_nac;

        return $this;
    }

    public function getRecogida(): ?string
    {
        return $this->recogida;
    }

    public function setRecogida(string $recogida): self
    {
        $this->recogida = $recogida;

        return $this;
    }

    public function getSexo(): ?string
    {
        return $this->sexo;
    }

    public function setSexo(string $sexo): self
    {
        $this->sexo = $sexo;

        return $this;
    }

    public function getUsuario(): ?User
    {
        return $this->usuario;
    }

    public function setUsuario(?User $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getRaza(): ?Raza
    {
        return $this->raza;
    }

    public function setRaza(?Raza $raza): self
    {
        $this->raza = $raza;

        return $this;
    }

    public function getChip(): ?int
    {
        return $this->chip;
    }

    public function setChip(int $chip): self
    {
        $this->chip = $chip;

        return $this;
    }

    
}
