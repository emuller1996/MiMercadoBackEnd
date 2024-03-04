<?php

namespace App\Entity;

use App\Repository\ItemMercadoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ItemMercadoRepository::class)]
class ItemMercado
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('item')]
    private ?int $id = null;



    #[ORM\Column]
    #[Assert\NotBlank]
    private ?int $cantidad = null;

    #[Assert\NotBlank]
    #[ORM\Column(length: 255)]
    private ?string $unidad = null;

    #[ORM\ManyToOne(inversedBy: 'items')]
    #[Groups('item_mercado')]
    private ?Mercado $mercado = null;

    #[ORM\ManyToMany(targetEntity: Item::class, inversedBy: 'item')]
    private Collection $item;

    public function __construct()
    {
        $this->item = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getCantidad(): ?int
    {
        return $this->cantidad;
    }

    public function setCantidad(int $cantidad): static
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    public function getUnidad(): ?string
    {
        return $this->unidad;
    }

    public function setUnidad(string $unidad): static
    {
        $this->unidad = $unidad;

        return $this;
    }

    public function getMercado(): ?Mercado
    {
        return $this->mercado;
    }

    public function setMercado(?Mercado $mercado): static
    {
        $this->mercado = $mercado;

        return $this;
    }

    /**
     * @return Collection<int, Item>
     */
    public function getItem(): Collection
    {
        return $this->item;
    }

    public function addItem(Item $item): static
    {
        if (!$this->item->contains($item)) {
            $this->item->add($item);
        }

        return $this;
    }

    public function removeItem(Item $item): static
    {
        $this->item->removeElement($item);

        return $this;
    }
}
