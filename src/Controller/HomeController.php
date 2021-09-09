<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * 
     * Default route no locale
     * 
     * @Route("/")
     */
    public function indexNoLocale(): Response
    {
        return $this->redirectToRoute('homepage', ['_locale' => 'en']);
    }



    /**
     * @Route("/{_locale<%app.supported_locales%>}/", name="homepage")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', []);
    }
}
