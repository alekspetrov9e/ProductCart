<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HelloController extends AbstractController
{
    #[Route('/hello/{name}', name: 'app_hello')]
    public function index(string $name): Response
    {
        return $this->render('hello/index.html.twig', [
            'name' => $name,
            'controller_name' => 'HelloController',
        ]);
    }
}
