<?php

namespace App\Controller;



use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class KontaktController extends AbstractController
{
    #[Route('/kontakt', name: 'app_kontakt')]
    public function index(MailerInterface $mailer, Request $request): Response
    {
        $kontaktForm = $this->createFormBuilder()
            ->add('Name', TextType::class)
            ->add('E-Mail', TextType::class )
            ->add('Nachricht', TextareaType::class,[
                'attr' => array('rows' => '5')
            ])
            ->add('Absenden', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-outline-danger float-right'
                    ]
            ])
            ->getForm();

        $kontaktForm->handleRequest($request);

    if($kontaktForm->isSubmitted()){
        $eingabe = $kontaktForm->getData();
        $name = ($eingabe['Name']);
        $email = ($eingabe['E-Mail']);
        $text = ($eingabe['Nachricht']);

        $email = (new TemplatedEmail())
            ->from('anmeldung@pec-weissach.com')
            ->to('info@pec-weissach.com')
            ->subject('Kontakt über die Webseite')
            ->htmlTemplate('mailer/kontakt.html.twig')

            ->context([
                'name' => $name,
                'mail' => $email,
                'text' => $text
            ]);

        $mailer->send($email);
        $this->addFlash('nachricht','Nachricht wurde versendet');
        return $this->redirect($this->generateUrl('app_kontakt'));

    }
    return $this->render('kontakt/index.html.twig',[
        'kontaktForm' => $kontaktForm->createView()
    ]);

    }
}
