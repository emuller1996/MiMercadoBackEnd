<?php

namespace App\Entity;

use App\Repository\ItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemRepository::class)]
class Item
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\ManyToMany(targetEntity: ItemMercado::class, mappedBy: 'item')]
    private Collection $item;

    public function __construct()
    {
        $this->item = new ArrayCollection();
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

    /**
     * @return Collection<int, ItemMercado>
     */
    public function getItem(): Collection
    {
        return $this->item;
    }

    public function addItem(ItemMercado $item): static
    {
        if (!$this->item->contains($item)) {
            $this->item->add($item);
            $item->addItem($this);
        }

        return $this;
    }

    public function removeItem(ItemMercado $item): static
    {
        if ($this->item->removeElement($item)) {
            $item->removeItem($this);
        }

        return $this;
    }
}
