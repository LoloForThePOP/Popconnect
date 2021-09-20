<?php

namespace App\Controller;

use App\Form\ContactWebsiteType;
use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{

    
    /**
     * 
     * Default route no locale
     * 
     * @Route("/contat-us/")
     */
    public function indexNoLocale(): Response
    {
        return $this->redirectToRoute('contact_website', ['_locale' => 'en']);
    }


     /**
      * 
     * Allow visitors to access contact website page and type messages
     * 
     * @Route("/{_locale<%app.supported_locales%>}/contact-us/", name="contact_website")
     */
    public function contactWebsite(Request $request, MailerInterface $mailer): Response
    {
        
        $form = 
        
            $this->createForm(

                ContactWebsiteType::class, null,
                array(

                    // Time protection
                    'antispam_time'     => true,
                    'antispam_time_min' => 4,
                    'antispam_time_max' => 3600,
                )
            );


        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {

            $sender = $form->get('authorEmail')->getData();

            $email = (new TemplatedEmail())
                ->from($sender)
                ->to(new Address('contact@projectofprojects.com'))
                ->subject('New Message from The POP Connection')

                // path of the Twig template to render
                ->htmlTemplate('contact/display_user_email_template.html.twig')

                // pass variables (name => value) to the template
                ->context([
                    'emailContent' => $form->get('content')->getData(),
                ]);

            $mailer->send($email);
            
            $this->addFlash(
                'success',
                "✅ Your message has been sent. See you."
            );

            return $this->redirectToRoute('homepage', []);
        }

        return $this->render('contact/contact_us.html.twig', [

            'form' => $form->createView(),
            
        ]);

    }

  
    






}
