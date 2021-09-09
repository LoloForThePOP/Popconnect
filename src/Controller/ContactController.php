<?php

namespace App\Controller;

use App\Form\ContactWebsiteType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{


     /**
      * 
     * Allow visitors to access contact website page and type messages
     * 
     * @Route("/contact-us/", name="contact_website")
     */
    public function contactWebsite(Request $request): Response
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
            
            $this->addFlash(
                'success',
                "✅ Votre Message a été envoyé"
            );

            return $this->redirectToRoute('homepage', []);
        }

        return $this->render('contact/contact_us.html.twig', [

            'form' => $form->createView(),
            
        ]);

    }

  
    






}
