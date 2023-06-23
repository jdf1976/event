<?php

namespace App\Controller;

use App\Entity\Anmeldung;
use App\Form\AnmeldungType;
use App\Repository\AnmeldungRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/anmeldung/crud')]
class AnmeldungCrudController extends AbstractController
{
    #[Route('/', name: 'app_anmeldung_crud_index', methods: ['GET'])]
    public function index(AnmeldungRepository $anmeldungRepository): Response
    {
        return $this->render('anmeldung_crud/index.html.twig', [
            'anmeldungs' => $anmeldungRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_anmeldung_crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AnmeldungRepository $anmeldungRepository): Response
    {
        $anmeldung = new Anmeldung();
        $form = $this->createForm(AnmeldungType::class, $anmeldung);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $anmeldungRepository->save($anmeldung, true);

            return $this->redirectToRoute('app_anmeldung_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('anmeldung_crud/new.html.twig', [
            'anmeldung' => $anmeldung,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_anmeldung_crud_show', methods: ['GET'])]
    public function show(Anmeldung $anmeldung): Response
    {
        return $this->render('anmeldung_crud/show.html.twig', [
            'anmeldung' => $anmeldung,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_anmeldung_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Anmeldung $anmeldung, AnmeldungRepository $anmeldungRepository): Response
    {
        $form = $this->createForm(AnmeldungType::class, $anmeldung);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $anmeldungRepository->save($anmeldung, true);

            return $this->redirectToRoute('app_anmeldung_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('anmeldung_crud/edit.html.twig', [
            'anmeldung' => $anmeldung,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_anmeldung_crud_delete', methods: ['POST'])]
    public function delete(Request $request, Anmeldung $anmeldung, AnmeldungRepository $anmeldungRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$anmeldung->getId(), $request->request->get('_token'))) {
            $anmeldungRepository->remove($anmeldung, true);
        }

        return $this->redirectToRoute('app_anmeldung_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
