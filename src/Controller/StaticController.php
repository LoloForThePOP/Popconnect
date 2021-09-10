<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StaticController extends AbstractController
{

    /**
     * 
     * Default route no locale
     * 
     * @Route("/static/{page_name}/")
     */
    public function indexNoLocale(): Response
    {
        return $this->redirectToRoute('static', ['_locale' => 'en']);
    }



    /**
     * @Route("/static/{_locale<%app.supported_locales%>}/{page_name}", name="static")
     */
    public function route($page_name): Response
    {

        return $this->render('static/'.$page_name.'.html.twig', []);

    }
}
