<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AppController extends Controller
{

    public function mentionsLegalesAction()
    {
        return $this->render('default/mentionsLegales.html.twig');
    }

    public function informationsAction()
    {
        return $this->render('default/informations.html.twig');
    }

    public function contactAction(Request $request)
    {
        // Create the form according to the FormType created previously.
        // And give the proper parameters
        $form = $this->createForm('AppBundle\Form\ContactType', null, array(
            // To set the action use $this->generateUrl('route_identifier')
            'action' => $this->generateUrl('contact'),
            'method' => 'POST'
        ));

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                // Send mail
                if ($this->sendEmail($form->getData())) {
                    //FLASH MESSAGE FOR REDIRECTION
                    $request
                        ->getSession()
                        ->getFlashBag()
                        ->add('ajoute', 'Le message a bien été transmis ! Merci');

                    return $this->redirectToRoute('contact');
                }
            }
        }
        return $this->render('default/contact.html.twig', array(
            'form' => $form->createView()
        ));
    }

    private function sendEmail($data)
    {

        $message = \Swift_Message::newInstance()
            ->setSubject($data["subject"])
            ->setFrom($data["email"])
            ->setReplyTo($data["email"])
            ->setTo('contact@annoncesport.fr')
            ->setContentType('text/html')
            ->setBody($data["message"]);

        if (!$this->get('mailer')->send($message)) {
            throw new Exception('Le mail n\'a pas pu être envoyé');
        }
    }
}