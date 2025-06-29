<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\ProductForm;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Product;

final class ProductController extends AbstractController
{
    #[Route('/products', name: 'product_index')]
    public function index(ProductRepository $repository): Response
    {
        $products = $repository->findAll();

        return $this->render('product/index.html.twig', [
            'products' => $products,
        ]);
    }
    #[Route('/product/{id<\d+>}', name: 'product_show')]
    public function show($id, ProductRepository $repository) :Response{

        $product = $repository->findOneBy(['id' => $id]);

        if ($product === null) {
            throw $this->createNotFoundException('Product not found');
        }
        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);
    }

    #[Route('/product/new', name: 'product_new')]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $product = new Product;

        $form = $this->createForm(ProductForm::class, $product);

        $form->handleRequest($request);

        if($form->isSubmitted()){
            $manager->persist($product);
            $manager->flush();

            return $this->redirectToRoute('product_show',
                ['id' => $product->getId()]);
        }
        return $this->render('product/new.html.twig',
        ['form' => $form]);
    }
}
