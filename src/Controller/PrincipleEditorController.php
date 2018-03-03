<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Principle;
use App\Form\PrincipleType;

class PrincipleEditorController extends Controller
{
    /**
     * @Route("/principles/edit/{title}", name="editprinciples", methods={"GET"}, defaults={title="here"})
     * 
     * Displays a list of principles for editing, adding more or removing.
     * 
     * @return object Symfony\Component\HttpFoundation\Response
     */
    public function display() : Response
    {
        //obtain the repository of principles
        $principleRepository = $this->getDoctrine()->getRepository(Principle::class);

        //get titles of all principles for the menu
        $principlesInMenu = $principleRepository->findAllTitles();

         //create a form for adding new principles
         $form = $this->createForm(PrincipleType::class);

        return $this->render('editprinciples.html.twig', [
            'description' => 'A secure access point for someone to',
            'keywords' => 'principles, edit, ',
            'title' => 'Edit, add or remove the Principles Of',
            'principlesInMenu' => $principlesInMenu,
            'form' => $form->createView()
        ]);
    }

    public function save() 
    {
       

    }
}
