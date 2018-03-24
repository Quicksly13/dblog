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
     * @Route("/principles/{title}", name="view_principles", methods={"GET"})
     * 
     * Displays principles on a web page.
     * 
     * @param string $title Default value is set here as default value in home route annotation causes mismatch for all routes
     * @return object Symfony\Component\HttpFoundation\Response
     */
    public function display(string $title = 'Dharmism - What and Why'): Response
    {
        //obtain the repository of principles
        $principleRepository = $this->getDoctrine()->getRepository(PrincipleEntity::class);

        //get the principle to be viewed on this page
        $principleToView = $principleRepository->findOneBy(['title' => $title]);

        //get titles of all principles for the menu
        $principlesInMenu = $principleRepository->findAllTitles();

        //find the principles before and after the principle to be viewed on this page
        $neighboursOfPrincipleToView = $principleRepository->findNeighboursByTitle($title, $principlesInMenu);
       
        //render the web page with the principle to be viewed and a menu to view other principles
        //obtain the HTTP response object containing the rendered page
        $response =  $this->render('principles/viewprinciples.html.twig', [
            'description' => $principleToView->getDescription(),
            'keywords' => $principleToView->getKeywords(),
            'title' => $principleToView->getTitle(),
            'explanation' => $principleToView->getExplanation(),
            'previous' => $neighboursOfPrincipleToView['previous'],
            'next' => $neighboursOfPrincipleToView['next'],
            'principlesInMenu' => $principlesInMenu
        ]);

        //set the response to cache for 3600 seconds
        $response->setSharedMaxAge(5);

        return $response;
    }
}
