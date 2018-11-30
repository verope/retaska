<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/homepage")
 */
class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="homepage_index", methods="GET")
     */
    public function index(ProductRepository $productRepository): Response
    {
        return $this->render('homepage/homepage.html.twig');
    }

   /**
     * @Route("/products_show", name="homepage_products", methods="GET|POST")
     */
    public function products_show(ProductRepository $productRepository): Response
    {

        return $this->render('homepage/show_all.html.twig', ['products' => $productRepository->findAll(),]);
    }

    /**
     * @Route("/{id}", name="product_show", methods="GET")
     */
    public function show(Product $product): Response
    {
        return $this->render('homepage/show.html.twig', ['product' => $product]);
    }


}
