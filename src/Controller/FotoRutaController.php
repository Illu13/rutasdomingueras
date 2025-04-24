<?php

namespace App\Controller;

use App\Entity\FotoRuta;
use App\Form\FotoRutaType;
use App\Repository\FotoRutaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/foto/ruta')]
final class FotoRutaController extends AbstractController
{
    #[Route(name: 'app_foto_ruta_index', methods: ['GET'])]
    public function index(FotoRutaRepository $fotoRutaRepository): Response
    {
        return $this->render('foto_ruta/index.html.twig', [
            'foto_rutas' => $fotoRutaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_foto_ruta_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $fotoRutum = new FotoRuta();
        $form = $this->createForm(FotoRutaType::class, $fotoRutum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($fotoRutum);
            $entityManager->flush();

            return $this->redirectToRoute('app_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('foto_ruta/new.html.twig', [
            'foto_rutum' => $fotoRutum,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_foto_ruta_show', methods: ['GET'])]
    public function show(FotoRuta $fotoRutum): Response
    {
        return $this->render('foto_ruta/show.html.twig', [
            'foto_rutum' => $fotoRutum,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_foto_ruta_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FotoRuta $fotoRutum, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FotoRutaType::class, $fotoRutum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_foto_ruta_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('foto_ruta/edit.html.twig', [
            'foto_rutum' => $fotoRutum,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_foto_ruta_delete', methods: ['POST'])]
    public function delete(Request $request, FotoRuta $fotoRutum, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fotoRutum->getId(), $request->getPayload()->getString('_token'))) {
            $filesystem = new Filesystem();
            $imageName = $fotoRutum->getImageName();
            $uploadDirectory = $this->getParameter('kernel.project_dir') . '/public/uploads/images/photos';
            $filePath = $uploadDirectory . '/' . $imageName;

            if ($filesystem->exists($filePath)) {
                $filesystem->remove($filePath);
            }
            $entityManager->remove($fotoRutum);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_foto_ruta_index', [], Response::HTTP_SEE_OTHER);
    }
}
