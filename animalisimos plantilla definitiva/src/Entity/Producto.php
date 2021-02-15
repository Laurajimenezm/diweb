<?php

namespace App\Entity;

use App\Repository\ProductoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProductoRepository::class)
 */
class Producto
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
    private $decripcion;

    /**
     * @Assert\NotBlank(message="El campo nombre no puede estar vacio")
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @Assert\NotBlank(message="El campo nombre no puede estar vacio")
     * @ORM\Column(type="integer", length=255)
     */
    private $stock;

    /**
     * @Assert\NotBlank(message="El campo nombre no puede estar vacio")
     * @ORM\Column(type="float")
     */
    private $precio;

    /**
     * @Assert\NotBlank(message="El campo nombre no puede estar vacio")
     * @ORM\OneToMany(targetEntity=Pedido::class, mappedBy="producto", orphanRemoval=true)
     */
    private $pedidos;

    /**
     * @Assert\NotBlank(message="El campo nombre no puede estar vacio")
     * @ORM\ManyToOne(targetEntity=Categoria::class, inversedBy="productos")
     */
    private $categoria;

    public function __construct()
    {
        $this->pedidos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDecripcion(): ?string
    {
        return $this->decripcion;
    }

    public function setDecripcion(string $decripcion): self
    {
        $this->decripcion = $decripcion;

        return $this;
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

    public function getStock(): ?float
    {
        return $this->stock;
    }

    public function setStock(float $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getPrecio(): ?float
    {
        return $this->precio;
    }

    public function setPrecio(float $precio): self
    {
        $this->precio = $precio;

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
            $pedido->setProducto($this);
        }

        return $this;
    }

    public function removePedido(Pedido $pedido): self
    {
        if ($this->pedidos->removeElement($pedido)) {
            // set the owning side to null (unless already changed)
            if ($pedido->getProducto() === $this) {
                $pedido->setProducto(null);
            }
        }

        return $this;
    }

    public function getCategoria(): ?Categoria
    {
        return $this->categoria;
    }

    public function setCategoria(?Categoria $categoria): self
    {
        $this->categoria = $categoria;

        return $this;
    }
}
