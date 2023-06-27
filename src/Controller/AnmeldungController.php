<?php

namespace App\Controller;

use App\Entity\Anmeldung;
use App\Form\AnmeldenType;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class AnmeldungController extends AbstractController
{
    #[Route('/anmeldung', name: 'app_anmeldung')]
    public function index(): Response
    {
        return $this->render('anmeldung/index.html.twig', [
            'controller_name' => 'AnmeldungController',
        ]);
    }

    #[Route('/anmelden/{id}', name: 'app_anmelden')]
    public function anmelden($id, EventRepository $eventRepository, Request $request, ManagerRegistry $doctrine)
    {
        $anmeldung = new Anmeldung();


        $event = $eventRepository->find($id);
        $id_nr = $event->getId();
        $name = $event->getName();
        $anzahl = $event->getAnzahl();

        $kontaktForm = $this->createForm(AnmeldenType::class, $anmeldung, [
            // Time protection
            'antispam_time'     => true,
            'antispam_time_min' => 10, // seconds
            'antispam_time_max' => 60,

            // Honeypot protection
            'antispam_honeypot'       => true,
            'antispam_honeypot_class' => 'hide-me',
            'antispam_honeypot_field' => 'email-repeat',
        ]);
        $kontaktForm->handleRequest($request);

        if ($kontaktForm->isSubmitted()) {

            //entity Manager anmeldung eintragen
            $anmeldung->setEventNr($id_nr);
            $em = $doctrine->getManager();
            $em->persist($anmeldung);
            $em->flush();

            //Teinehmer anzahl in Event bearbeiten
            $event->setAnzahl($anzahl - $anmeldung->getTeilnehmer());
            $em->persist($event);
            $em->flush();

            $this->addFlash('nachricht', $name . ' wurde angenommen.');

            return $this->redirect($this->generateUrl('app_menu'));

        }
        return $this->render('anmeldung/index.html.twig', [
            'anmeldeForm' => $kontaktForm->createView(),
            'id' => $id_nr,
            'name' => $name,
            'anzahl' => $anzahl
        ]);


    }
}
