<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(EventRepository $ev): Response
    {

        $events = $ev->findAll();
        $zufall = array_rand($events, 2);

        return $this->render('home/index.html.twig', [
            'event1' => $events[$zufall[0]],
            'event2' => $events[$zufall[1]],
        ]);
    }
}
