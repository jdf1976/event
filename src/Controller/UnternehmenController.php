<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UnternehmenController extends AbstractController
{
    #[Route('/unternehmen', name: 'app_unternehmen')]
    public function index(): Response
    {
        return $this->render('unternehmen/index.html.twig', [
            'controller_name' => 'UnternehmenController',
        ]);
    }
}
