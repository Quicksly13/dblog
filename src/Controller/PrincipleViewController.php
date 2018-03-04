<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\PrincipleEntity;

class PrincipleViewController extends Controller
{
    /**
     * @Route("/", name="home")
     * @Route("/principles/{title}", name="viewprinciples", methods={"GET"}, defaults={"title"="Principle1"})
     * 
     * Displays principles on a web page.
     * 
     * @param string $title
     * @return object Symfony\Component\HttpFoundation\Response
     */
    public function display(string $title) : Response
    {
        //obtain the repository of principles
        $principleRepository = $this->getDoctrine()->getRepository(PrincipleEntity::class);

        //get the principle to be viewed on this page
        $principleToView = $principleRepository->findOneBy(['title' => $title]);

        //get titles of all principles for the menu
        $principlesInMenu = $principleRepository->findAllTitles();
       
        //render the web page with the principle to be viewed and a menu to view other principles
        //obtain the HTTP response object containing the rendered page
        $response =  $this->render('viewprinciples.html.twig', [
            'description' => $principleToView->getDescription(),
            'keywords' => $principleToView->getKeywords(),
            'title' => $principleToView->getTitle(),
            'explanation' => $principleToView->getExplanation(),
            'principlesInMenu' => $principlesInMenu
        ]);

        //set the response to cache for 3600 seconds
        $response->setSharedMaxAge(5);

        return $response;
    }
}
