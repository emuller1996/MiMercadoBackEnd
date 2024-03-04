<?php

namespace App\Controller\Api;

use App\Entity\Mercado;
use App\Entity\Pedidos;
use App\Form\Type\PedidoFormType;
use App\Repository\MercadoRepository;
use App\Repository\PedidosRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\View as ViewAttribute;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PedidosController extends AbstractFOSRestController
{

    #[Get(path: "/pedidos")]
    #[ViewAttribute(serializerGroups: ['list_pedidos', 'mercados', 'itemmercado'], serializerEnableMaxDepthChecks: true)]
    public function list(PedidosRepository $pedididosRepository)
    {

        return $pedididosRepository->findAll();
    }


    #[Post(path: "/pedidos")]
    #[ViewAttribute(serializerGroups: ['list_pedidos', 'mercados', 'itemmercado'], serializerEnableMaxDepthChecks: true)]
    public function createPedido(Request $request, MercadoRepository $mercadoRepository, EntityManagerInterface $em,)
    {

        $pedido = new Pedidos();
        $form = $this->createForm(PedidoFormType::class, $pedido);
        $form->handleRequest($request);
        if (!$form->isSubmitted()) {
            return [null, 'Form is not submitted'];
        }
        if (!$form->isValid()) {
            return ['message' => 'Error ', $form];
        }

        $a = json_decode($request->getContent(), true);
        $mercados = $a["mercados"];
        $mercadosEntity = [];
        foreach ($mercados as $key => $value) {
            # code...
            $mercado = $mercadoRepository->find($value);
            $pedido->addMercado($mercado);
            $mercadosEntity[] = $mercado;
        }
        $em->persist($pedido);
        $em->flush();
        return ['message' => 'Pedido Creado Correctamente.', $pedido];
    }
}
