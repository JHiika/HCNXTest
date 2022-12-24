<?php

namespace App\Controller;

use App\Entity\NumeroDons;
use App\Form\NumeroDonsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/numero/dons')]
class NumeroDonsController extends AbstractController
{
    #[Route('/', name: 'app_numero_dons_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $numeroDons = $entityManager
            ->getRepository(NumeroDons::class)
            ->findAll();

        return $this->render('numero_dons/index.html.twig', [
            'numero_dons' => $numeroDons,
        ]);
    }

    #[Route('/new', name: 'app_numero_dons_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $numeroDon = new NumeroDons();
        $form = $this->createForm(NumeroDonsType::class, $numeroDon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($numeroDon);
            $entityManager->flush();

            return $this->redirectToRoute('app_numero_dons_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('numero_dons/new.html.twig', [
            'numero_don' => $numeroDon,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_numero_dons_show', methods: ['GET'])]
    public function show(NumeroDons $numeroDon): Response
    {
        return $this->render('numero_dons/show.html.twig', [
            'numero_don' => $numeroDon,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_numero_dons_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, NumeroDons $numeroDon, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(NumeroDonsType::class, $numeroDon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_numero_dons_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('numero_dons/edit.html.twig', [
            'numero_don' => $numeroDon,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_numero_dons_delete', methods: ['POST'])]
    public function delete(Request $request, NumeroDons $numeroDon, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$numeroDon->getId(), $request->request->get('_token'))) {
            $entityManager->remove($numeroDon);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_numero_dons_index', [], Response::HTTP_SEE_OTHER);
    }
}
