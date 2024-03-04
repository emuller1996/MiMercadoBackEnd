<?php

namespace App\Controller\Api;

use App\Entity\ItemMercado;
use App\Form\Type\ItemFormType;
use App\Repository\ItemMercadoRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\View as ViewAttribute;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

class ItemController extends AbstractFOSRestController
{

    #[Get(path: "/items-mercado")]
    #[ViewAttribute(serializerGroups: ['itemmercado'], serializerEnableMaxDepthChecks: true)]
    public function list(ItemMercadoRepository $itemRepository)
    {
        $itemsss = $itemRepository->findAll();
        return $itemsss;
    }

    #[Get(path: "/items-mercado/{id}")]
    #[ViewAttribute(serializerGroups: ['itemmercado', 'itemmercados', 'mercado'], serializerEnableMaxDepthChecks: true)]
    public function getById(ItemMercadoRepository $itemRepository, int $id)
    {
        $itemsss = $itemRepository->find($id);
        return $itemsss;
    }


    #[Post(path: "/items-mercado")]
    #[ViewAttribute(serializerGroups: ['itemmercado'], serializerEnableMaxDepthChecks: true)]
    public function create(EntityManagerInterface $em, Request $request)
    {
        $item = new ItemMercado();
        $form = $this->createForm(ItemFormType::class, $item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($item);
            $em->flush();
            return $item;
        }

        return $form;
    }

    #[Put(path: "/items-mercado/{id}")]
    #[ViewAttribute(serializerGroups: ['itemmercado'], serializerEnableMaxDepthChecks: true)]
    public function edit(EntityManagerInterface $em, ItemMercadoRepository $itemRepository, Request $request, int $id)
    {
        $itemDB = $itemRepository->find($id);
        if (!$itemDB) {
            throw $this->createNotFoundException(
                'No item found for id ' . $id
            );
        }
        $item = new ItemMercado();
        $form = $this->createForm(ItemFormType::class, $item);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);
        if ($form->isValid()) {
            $itemDB->setUnidad($form->getData()->getUnidad());
            $itemDB->setCantidad($form->getData()->getCantidad());
            $em->persist($itemDB);
            $em->flush();
            return $itemDB;
        }
        return $form;
    }

    #[Delete(path: "/items-mercado/{id}")]
    #[ViewAttribute(serializerGroups: ['itemmercado'], serializerEnableMaxDepthChecks: true)]
    public function delete(EntityManagerInterface $em, ItemMercadoRepository $itemRepository, Request $request, int $id)
    {
        $itemDB = $itemRepository->find($id);
        if (!$itemDB) {
            throw $this->createNotFoundException(
                'No item found for id ' . $id
            );
        }


        $em->remove($itemDB);
        $em->flush();

        return ['message' => 'Se Elimino Correctametne'];
    }
}
