<?php

namespace App\Entity;

use App\Repository\PedidoRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PedidoRepository::class)
 */
class Pedido
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="El campo nombre no puede estar vacio")
     * @ORM\Column(type="integer")
     */
    private $cantidad;

    /**
     * @Assert\NotBlank(message="El campo nombre no puede estar vacio")
     * @ORM\ManyToOne(targetEntity=Compra::class, inversedBy="pedidos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Compra;

    /**
     * @Assert\NotBlank(message="El campo nombre no puede estar vacio")
     * @ORM\ManyToOne(targetEntity=Producto::class, inversedBy="pedidos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $producto;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCantidad(): ?int
    {
        return $this->cantidad;
    }

    public function setCantidad(int $cantidad): self
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    public function getCompra(): ?Compra
    {
        return $this->Compra;
    }

    public function setCompra(?Compra $Compra): self
    {
        $this->Compra = $Compra;

        return $this;
    }

    public function getProducto(): ?Producto
    {
        return $this->producto;
    }

    public function setProducto(?Producto $producto): self
    {
        $this->producto = $producto;

        return $this;
    }
}
