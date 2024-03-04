<?php


namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ItemMercado as ItemMercadoEntity;
use Doctrine\ORM\EntityManagerInterface;

class ItemMercado extends AbstractController
{

    private $logger;
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    #[Route('/itemMercado/', name: 'listar', methods: ['GET'])]
    public function listar()
    {

        $this->logger->info("Lista Item Mercadio");

        $res =  new JsonResponse(['Message' => 'listar']);
        return $res;
    }

    #[Route('/itemMercado/', name: 'crear', methods: ['POST'])]

    public function crear(EntityManagerInterface $em)
    {
        $itemMercado = new ItemMercadoEntity();
        $itemMercado->setNombre('Cebolla');
        $itemMercado->setUnidad('Kg');
        $itemMercado->setCantidad(2);

        $em->persist($itemMercado);
        $em->flush($itemMercado);


        $this->logger->info("Crear Item Mercadio");

        $res =  new JsonResponse(['Message' => 'Creado', 'data' => ['nombre' => $itemMercado->getNombre()]]);
        return $res;
    }
}
