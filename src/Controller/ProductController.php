<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/product", name="product_")
 */
class ProductController extends AbstractController
{
    /**
     * @Route("/{productId}", name="show" , requirements={"productId"="\d+"})
     */
    public function index(ProductRepository $pr, $productId): Response
    {
        $product = $pr->find($productId);

        return $this->render('product/index.html.twig', [
            'productId'=>$productId,
            'product'=>$product
        ]);
    }
}
