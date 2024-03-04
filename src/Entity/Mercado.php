<?php

namespace App\Entity;

use App\Repository\MercadoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: MercadoRepository::class)]
class Mercado
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $nombre = null;

    #[Assert\NotBlank]
    #[ORM\Column(type: Types::DECIMAL, precision: 20, scale: '0')]
    private ?string $valor = null;

    #[ORM\OneToMany(mappedBy: 'mercado', targetEntity: ItemMercado::class)]
    private Collection $items;

    #[ORM\Column(nullable: true)]
    #[Assert\NotBlank]
    private ?bool $estado = null;

    #[ORM\ManyToMany(targetEntity: Pedidos::class, mappedBy: 'mercados')]
    private Collection $pedidos;

    public function __construct()
    {
        $this->items = new ArrayCollection();
        $this->pedidos = new ArrayCollection();
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

    public function getValor(): ?string
    {
        return $this->valor;
    }

    public function setValor(string $valor): static
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * @return Collection<int, ItemMercado>
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(ItemMercado $item): static
    {
        if (!$this->items->contains($item)) {
            $this->items->add($item);
            $item->setMercado($this);
        }

        return $this;
    }

    public function removeItem(ItemMercado $item): static
    {
        if ($this->items->removeElement($item)) {
            // set the owning side to null (unless already changed)
            if ($item->getMercado() === $this) {
                $item->setMercado(null);
            }
        }

        return $this;
    }

    public function isEstado(): ?bool
    {
        return $this->estado;
    }

    public function setEstado(?bool $estado): static
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * @return Collection<int, Pedidos>
     */
    public function getPedidos(): Collection
    {
        return $this->pedidos;
    }

    public function addPedido(Pedidos $pedido): static
    {
        if (!$this->pedidos->contains($pedido)) {
            $this->pedidos->add($pedido);
            $pedido->addMercado($this);
        }

        return $this;
    }

    public function removePedido(Pedidos $pedido): static
    {
        if ($this->pedidos->removeElement($pedido)) {
            $pedido->removeMercado($this);
        }

        return $this;
    }
}
