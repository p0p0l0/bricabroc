<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
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
     * @Route("/index", name="index")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/create", name="create")
     */
    public function create(EntityManagerInterface $em, Request $request){

        $product = new Product();
        $form =$this->createForm(ProductType::class,$product);

        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($product);
            $em->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('admin/create.html.twig',[
            'form'=>$form->createView()
        ]);

    }
}
