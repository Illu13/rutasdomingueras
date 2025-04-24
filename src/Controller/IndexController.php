<?php

namespace App\Controller;

use App\Repository\RutaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class IndexController extends AbstractController
{
    #[Route('/ ', name: 'app_index')]
    public function index(RutaRepository $rutaRepository): Response
    {
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            'rutas' => $rutaRepository->findAll(),
        ]);
    }
}
