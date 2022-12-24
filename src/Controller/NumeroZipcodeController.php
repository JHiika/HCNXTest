<?php

namespace App\Controller;

use App\Entity\NumeroZipcode;
use App\Form\NumeroZipcodeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/numero/zipcode')]
class NumeroZipcodeController extends AbstractController
{
    #[Route('/', name: 'app_numero_zipcode_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $numeroZipcodes = $entityManager
            ->getRepository(NumeroZipcode::class)
            ->findAll();

        return $this->render('numero_zipcode/index.html.twig', [
            'numero_zipcodes' => $numeroZipcodes,
        ]);
    }

    #[Route('/new', name: 'app_numero_zipcode_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $numeroZipcode = new NumeroZipcode();
        $form = $this->createForm(NumeroZipcodeType::class, $numeroZipcode);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($numeroZipcode);
            $entityManager->flush();

            return $this->redirectToRoute('app_numero_zipcode_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('numero_zipcode/new.html.twig', [
            'numero_zipcode' => $numeroZipcode,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_numero_zipcode_show', methods: ['GET'])]
    public function show(NumeroZipcode $numeroZipcode): Response
    {
        return $this->render('numero_zipcode/show.html.twig', [
            'numero_zipcode' => $numeroZipcode,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_numero_zipcode_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, NumeroZipcode $numeroZipcode, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(NumeroZipcodeType::class, $numeroZipcode);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_numero_zipcode_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('numero_zipcode/edit.html.twig', [
            'numero_zipcode' => $numeroZipcode,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_numero_zipcode_delete', methods: ['POST'])]
    public function delete(Request $request, NumeroZipcode $numeroZipcode, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$numeroZipcode->getId(), $request->request->get('_token'))) {
            $entityManager->remove($numeroZipcode);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_numero_zipcode_index', [], Response::HTTP_SEE_OTHER);
    }
}
