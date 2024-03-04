<?php

namespace App\Entity;

use App\Repository\PedidosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PedidosRepository::class)]
class Pedidos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $fecha = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $estado = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 20, scale: '0', nullable: true)]
    private ?string $valor = null;

    #[ORM\ManyToMany(targetEntity: Mercado::class, inversedBy: 'pedidos')]
    private Collection $mercados;

    public function __construct()
    {
        $this->mercados = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(?\DateTimeInterface $fecha): static
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(?string $estado): static
    {
        $this->estado = $estado;

        return $this;
    }

    public function getValor(): ?string
    {
        return $this->valor;
    }

    public function setValor(?string $valor): static
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * @return Collection<int, Mercado>
     */
    public function getMercados(): Collection
    {
        return $this->mercados;
    }

    public function addMercado(Mercado $mercado): static
    {
        if (!$this->mercados->contains($mercado)) {
            $this->mercados->add($mercado);
        }

        return $this;
    }

    public function removeMercado(Mercado $mercado): static
    {
        $this->mercados->removeElement($mercado);

        return $this;
    }
}
