<?php

namespace App\Controller;

use App\Entity\PurchaseOrder;
use App\Entity\Product;
use App\Form\PlaceOrderType;
use App\Repository\PurchaseOrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/place_order")
 */
class PlaceOrderController extends AbstractController
{
    /**
     * @Route("/new/{id}", name="place_order_new", methods="GET|POST")
     */
    public function new(Product $product, Request $request): Response
    {
        $purchaseOrder = new PurchaseOrder();
        $form = $this->createForm(PlaceOrderType::class, $purchaseOrder);
        $form->handleRequest($request); 
        
        if ($form->isSubmitted() && $form->isValid() && $product->getInStockCount() > 0) {
            $em = $this->getDoctrine()->getManager();
            $purchaseOrder->setCreatedDate(new \DateTime);
            $purchaseOrder->setStatus(PurchaseOrder::STATUS_NEW);
            $product->decreaseInStockCount($purchaseOrder->getNumberOfUnits());
            $em->persist($purchaseOrder);
            $em->flush();

            return $this->redirectToRoute('place_order_done', ['id' => $purchaseOrder->getId()]);
        }

        return $this->render('place_order/new.html.twig', [
            'purchase_order' => $purchaseOrder,
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }
    
    
    /**
     * @Route("/done/{id}", name="place_order_done", methods="GET")
     */
    public function show(PurchaseOrder $purchaseOrder): Response
    {
        return $this->render('place_order/done.html.twig', ['purchase_order' => $purchaseOrder]);
    }
    

}
