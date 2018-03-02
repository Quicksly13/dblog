<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class PrincipleController extends Controller
{
    /**
     * @Route("/", name="home")
     * @Route("/principles/{title}", name="principles")
     * 
     * @param string $title
     * @return object Symfony\Component\HttpFoundation\Response
     */
    public function show(string $title = 'hello') : Response
    {
       

        return $this->render('principles.html.twig', []);
    }
}
