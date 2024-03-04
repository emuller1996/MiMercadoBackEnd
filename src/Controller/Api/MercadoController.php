<?php

namespace App\Controller\Api;

use App\Entity\ItemMercado;
use App\Entity\Mercado;
use App\Form\Type\MercadoType;
use App\Repository\ItemMercadoRepository;
use App\Repository\ItemRepository;
use App\Repository\MercadoRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\View as ViewAttribute;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class MercadoController extends AbstractFOSRestController
{

    #[Get(path: "/mercados")]
    #[ViewAttribute(serializerGroups: ['mercados', 'itemmercado','list_item'], serializerEnableMaxDepthChecks: true)]
    public function list(MercadoRepository $mercadoRepository)
    {

        return $mercadoRepository->findAll();
    }


    #[Post(path: "/mercados")]
    #[ViewAttribute(serializerGroups: ['mercados', 'itemmercado', 'list_item'], serializerEnableMaxDepthChecks: true)]

    public function create(
        EntityManagerInterface $em,
        ItemRepository $itemsRepository,
        ItemMercadoRepository $itemMercadoRepository,
        Request $request
    ) {
        $mercadonew = new Mercado();
        $form = $this->createForm(MercadoType::class, $mercadonew);
        $form->handleRequest($request);

        if (!$form->isSubmitted()) {
            return [null, 'Form is not submitted'];
        }
        if (!$form->isValid()) {
            return [null, $form];
        }
        $body =  json_decode($request->getContent(), true);
        $items = $body["items"];
        foreach ($items as $key => $value) {
            $itemMercado = new ItemMercado();
            $itemMercado->setCantidad($value["cantidad"]);
            $itemMercado->setUnidad($value["unidad"]);
            $item = $itemsRepository->find($value["id"]);
            $itemMercado->addItem($item);
            $em->persist($itemMercado);
            $mercadonew->addItem($itemMercado);
        }

        $em->persist($mercadonew);
        $em->flush();
        return $items;
    }

    #[Post(path: "/mercados/{id}/items")]
    #[ViewAttribute(serializerGroups: ['mercados', 'itemmercado'], serializerEnableMaxDepthChecks: true)]
    public function asignarItem(EntityManagerInterface $em, MercadoRepository $mecardoRepository, ItemMercadoRepository $itemRepository, Request $request, int $id)
    {
        $itemDB = $mecardoRepository->find($id);
        if (!$itemDB) {
            throw $this->createNotFoundException(
                'No item found for id ' . $id
            );
        }
        $s = json_decode($request->getContent(), true);

        foreach ($itemDB->getItems() as $value) {
            $itemDB->removeItem($value);
        }
        foreach ($s['items'] as $value) {
            $ite = $itemRepository->find($value);
            if ($ite) {
                if (!$ite->getMercado()) {
                    $itemDB->addItem($ite);
                }
            }
        }
        $em->persist($itemDB);
        $em->flush();
        return $itemDB;
    }
}
