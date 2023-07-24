<?php

namespace App\Controller;

use App\Entity\Anmeldung;
use App\Form\AnmeldenType;
use App\Repository\EventRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Mailer\MailerInterface;

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
    public function anmelden($id, EventRepository $eventRepository, Request $request, ManagerRegistry $doctrine, MailerInterface $mailer)
    {
        $anmeldung = new Anmeldung();


        $event = $eventRepository->find($id);
        $id_nr = $event->getId();
        $name = $event->getName();
        $anzahl = $event->getAnzahl();
        $code = $event->getCode();
        if(!empty($event->getCode())) {
            $anmeldung->setIsSpecialEvent(true);
        }


        $anmeldeForm = $this->createForm(AnmeldenType::class, $anmeldung, [
            // Time protection
            'antispam_time' => true,
            'antispam_time_min' => 10, // seconds
            'antispam_time_max' => 60,

            // Honeypot protection
            'antispam_honeypot' => true,
            'antispam_honeypot_class' => 'hide-me',
            'antispam_honeypot_field' => 'email-repeat',

        ]);
        $anmeldeForm->handleRequest($request);

        if ($anmeldeForm->isSubmitted() && $anmeldeForm->isValid()) {

            /** @var Anmeldung $daten */
            $daten = $anmeldeForm->getData();
            $errorCounter = 0;
            if ($daten->isSpecialEvent()) {
                if($event->getCode() != $daten->getCode()) {
                    $error = new FormError("Code ist falsch");
                    $anmeldeForm->get('code')->addError($error);
                    $errorCounter++;
                }
            }

            if (!$daten->isDatenschutz()) {
                $error = new FormError("Bitte Datenschutz akzeptieren");
                $anmeldeForm->get('datenschutz')->addError($error);
                $errorCounter++;
            }

            if (!$daten->isFoto()) {
                $error = new FormError("Bitte Einwilligung für Bilder akzeptieren");
                $anmeldeForm->get('foto')->addError($error);
                $errorCounter++;
            }

            if($errorCounter > 0) {
                return $this->formRender($anmeldeForm, $id_nr, $name, $anzahl);
            }


            $event_id = $event->getId();
            $event_bez = $event->getName();
            $datum = $event->getDatum();

            $teilnehmer = $daten->getTeilnehmer();
            $anmeldemail = $daten->getEmail();
            $anmeldename = $daten->getName();
            $zeit = $event->getZeit();

            //entity Manager anmeldung eintragen
            $anmeldung->setEventNr($id_nr);
            $em = $doctrine->getManager();
            $em->persist($anmeldung);
            $em->flush();

            //Teinehmer anzahl in Event bearbeiten
            $event->setAnzahl($anzahl - $anmeldung->getTeilnehmer());
            $em->persist($event);
            $em->flush();

            $email = (new TemplatedEmail())
                ->from('anmeldung@pec-weissach.com')
                ->to('anmeldung@pec-weissach.com')
                ->subject('Anmeldung über die Webseite')
                ->htmlTemplate('mailer/anmeldung.html.twig')
                ->context([
                    'name' => $anmeldename,
                    'mail' => $anmeldemail,
                    'teilnehmer' => $teilnehmer,
                    'datum' => $datum,
                    'event' => $event_bez,
                    'id' => $event_id,
                    'zeit' => $zeit,
                ]);

            $mailer->send($email);

            $email = (new TemplatedEmail())
                ->from('anmeldung@pec-weissach.com')
                ->to($anmeldemail)
                ->subject('Anmeldung über die Webseite')
                ->htmlTemplate('mailer/anmeldung.html.twig')
                ->context([
                    'name' => $anmeldename,
                    'mail' => $anmeldemail,
                    'teilnehmer' => $teilnehmer,
                    'datum' => $datum,
                    'event' => $event_bez,
                    'id' => $event_id,
                    'zeit' => $zeit,
                ]);

            $mailer->send($email);


            $this->addFlash('nachricht', 'Nachricht wurde versendet');

            $this->addFlash('nachricht', $name . ' wurde angenommen.');

            return $this->redirect($this->generateUrl('app_menu'));

        }
        return $this->formRender($anmeldeForm, $id_nr, $name, $anzahl);


    }


    public function formRender(FormInterface $anmeldeForm, int $id = null, string $name, int $anzahl) {
        return $this->render('anmeldung/index.html.twig', [
            'anmeldeForm' => $anmeldeForm->createView(),
            'id' => $id,
            'name' => $name,
            'anzahl' => $anzahl
        ]);
    }
}
