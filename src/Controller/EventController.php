<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Config\DoctrineConfig;

#[Route('/event', name: 'event.')]
class EventController extends AbstractController
{
    #[Route('/', name: 'liste')]
    public function index(EventRepository $ev): Response
    {
        $events = $ev->findAll();

        return $this->render('event/index.html.twig', [
            'events' => $events,
        ]);
    }

    #[Route('/anlegen', name: 'anlegen')]
    public function anlegen(ManagerRegistry $doctrine, Request $request): Response
    {
        $event = new Event();
        // Formular
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted()){
            // EntityManager
            $em = $doctrine->getManager();

            $bild = $request->files->get('event')['bild'];

            if($bild){
                $dateiname = md5(uniqid()). '.' .$bild->guessClientExtension();
            }

            $bild->move(
                $this->getParameter('bilder_ordner'),
                $dateiname
            );

            $event->setBild($dateiname);

            $em->persist($event);
            $em->flush();

            return $this->redirect($this->generateUrl('event.liste'));
        }
        return $this->render('event/anlegen.html.twig', [
            'anlegenForm' => $form->createView(),
        ]);
    }
    #[Route('/entfernen/{id}', name: 'entfernen')]
    public function entfernen($id, EventRepository $ev, ManagerRegistry $doctrine){
        // EntityManager
        $em = $doctrine->getManager();
        $event = $ev->find($id);
        $em->remove($event);
        $em->flush();

        $this->addFlash('Erfolg', 'Event wurde erfolgreich entfernt.');

        return $this->redirect($this->generateUrl('event.liste'));
    }
    #[Route('/anzeigen/{id}', name: 'anzeigen')]
    public function anzeigen(Event $event){
        return $this->render('event/anzeigen.html.twig', [
            'events' => $event,
        ]);
    }

}
