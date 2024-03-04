<?php

namespace App\Controller\Api;

use App\Entity\Item;
use App\Entity\ItemMercado;
use App\Form\Type\ItemFormType;
use App\Repository\ItemMercadoRepository;
use App\Repository\ItemRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;

use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\View as ViewAttribute;


class ItemSingleController extends AbstractFOSRestController
{

    #[Get(path: "/items")]
    #[ViewAttribute(serializerGroups: ['list_item'], serializerEnableMaxDepthChecks: true)]
    public function list(ItemRepository $itemRepository)
    {
        $itemsss = $itemRepository->findAll();
        return $itemsss;
    }

    #[Post(path: "/items/{name}")]
    #[ViewAttribute(serializerGroups: ['list_item'], serializerEnableMaxDepthChecks: true)]
    public function create(
        string $name,
        EntityManagerInterface $em
    ) {


        $item = new Item();
        $item->setNombre($name);
        $em->persist($item);
        $em->flush();

        return ['message' => 'Item Creado', 'data' => $item];
    }
}
