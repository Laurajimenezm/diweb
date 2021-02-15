<?php

namespace App\Entity;

use App\Repository\CompraRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CompraRepository::class)
 */
class Compra
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="El campo nombre no puede estar vacio")
     * @ORM\Column(type="datetime")
     */
    private $fecha_compra;

    /**
     * @Assert\NotBlank(message="El campo nombre no puede estar vacio")
     * @ORM\Column(type="float")
     */
    private $montante;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="compras")
     * @ORM\JoinColumn(nullable=false)
     */
    private $usuario;

    /**
     * @ORM\OneToMany(targetEntity=Pedido::class, mappedBy="Compra", orphanRemoval=true)
     */
    private $pedidos;

    public function __construct()
    {
        $this->pedidos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechaCompra(): ?\DateTimeInterface
    {
        return $this->fecha_compra;
    }

    public function setFechaCompra(\DateTimeInterface $fecha_compra): self
    {
        $this->fecha_compra = $fecha_compra;

        return $this;
    }

    public function getMontante(): ?float
    {
        return $this->montante;
    }

    public function setMontante(float $montante): self
    {
        $this->montante = $montante;

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

    /**
     * @return Collection|Pedido[]
     */
    public function getPedidos(): Collection
    {
        return $this->pedidos;
    }

    public function addPedido(Pedido $pedido): self
    {
        if (!$this->pedidos->contains($pedido)) {
            $this->pedidos[] = $pedido;
            $pedido->setCompra($this);
        }

        return $this;
    }

    public function removePedido(Pedido $pedido): self
    {
        if ($this->pedidos->removeElement($pedido)) {
            // set the owning side to null (unless already changed)
            if ($pedido->getCompra() === $this) {
                $pedido->setCompra(null);
            }
        }

        return $this;
    }
}
