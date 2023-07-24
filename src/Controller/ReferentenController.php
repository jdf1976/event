<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReferentenController extends AbstractController
{
    #[Route('/referenten', name: 'app_referenten')]
    public function index(): Response
    {
        return $this->render('referenten/index.html.twig', [
            'controller_name' => 'ReferentenController',
        ]);
    }
}
