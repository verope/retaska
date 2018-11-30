<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/product/detail")
 */
class ProductDetailController extends AbstractController
{
    /**
     * @Route("/{id}", name="product_detail", methods="GET")
     */
    public function product_detail(Product $product): Response
    {
        return $this->render('homepage/product_detail.html.twig', ['product' => $product]);
    }

}
