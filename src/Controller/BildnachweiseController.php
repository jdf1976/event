<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BildnachweiseController extends AbstractController
{
    #[Route('/bildnachweise', name: 'app_bildnachweise')]
    public function index(): Response
    {
        return $this->render('bildnachweise/index.html.twig', [
            'controller_name' => 'BildnachweiseController',
        ]);
    }
}
