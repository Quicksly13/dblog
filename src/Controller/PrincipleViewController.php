<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Principle;

class PrincipleViewController extends Controller
{
    /**
     * @Route("/", name="home")
     * @Route("/principles/{title}", name="principles", methods={"GET"}, defaults={"title"="Principle1"})
     * 
     * Displays principles on a web page.
     * 
     * @param string $title
     * @return object Symfony\Component\HttpFoundation\Response
     */
    public function display(string $title) : Response
    {
        //obtain the repository of principles
        $principleRepository = $this->getDoctrine()->getRepository(Principle::class);

        //get the principle to be viewed on this page
        $principleToView = $principleRepository->findOneBy(['title' => $title]);

        //get titles of all principles for the menu
        $principlesInMenu = $principleRepository->findAllTitles();
       
        //render the web page with the principle to be viewed and a menu to view other principles
        return $this->render('viewprinciples.html.twig', [
            'description' => $principleToView->getDescription(),
            'keywords' => $principleToView->getKeywords(),
            'title' => $principleToView->getTitle(),
            'explanation' => $principleToView->getExplanation(),
            'principlesInMenu' => $principlesInMenu
        ]);
    }
}
