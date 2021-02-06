<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\UserRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
/**
 * @Route("/admin", name="admin_")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/product", name="productList")
     */
    public function index(ProductRepository $pr): Response
    {
        $products = $pr->findAll();
        return $this->render('admin/productList.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @Route("/create", name="createProduct")
     */
    public function create(EntityManagerInterface $em, Request $request){

        $product = new Product();
        $form =$this->createForm(ProductType::class,$product);

        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($product);
            $em->flush();

            return $this->redirectToRoute('admin_updateProduct',[
                'productId'=>$product->getId()
            ]);
        }

        return $this->render('admin/create.html.twig',[
            'form'=>$form->createView()
        ]);

    }

    /**
     * @Route("/{productId}/update", name="updateProduct" ,requirements={"productId" ="\d+"})
     */
    public function updateProduct(EntityManagerInterface $em, ProductRepository $pr, Request $request, $productId){

        $product = $pr->find($productId);

        $form = $this->createForm(ProductType::class,$product);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em->flush();

            return $this->redirectToRoute('product_show',[
                'productId'=>$productId
            ]);
        }

        return $this->render('admin/create.html.twig',[
            'form'=>$form->createView()
        ]);


    }
}
