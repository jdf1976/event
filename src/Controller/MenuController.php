<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    #[Route('/menu', name: 'app_menu')]
    public function menu(EventRepository $eventRepository): Response
    {

        $events = $eventRepository->findBy(array(), array('datum' => 'ASC'));

        return $this->render('menu/index.html.twig', [
            'events' => $events,
        ]);
    }
}
