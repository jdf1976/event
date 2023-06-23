<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DatenschutzController extends AbstractController
{
    #[Route('/datenschutz', name: 'app_datenschutz')]
    public function index(): Response
    {
        return $this->render('datenschutz/index.html.twig', [
            'controller_name' => 'DatenschutzController',
        ]);
    }
}
