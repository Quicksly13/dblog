<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\PrincipleEntity;
use App\Form\PrincipleType;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class PrincipleEditController extends Controller
{
    /**
     * @Route("/principles/edit/{title}", name="editprinciples", methods={"GET"}, defaults={"title"="select"})
     * 
     * Displays a list of principles for editing, adding new or removing current.
     * 
     * @param string $title
     * @return object Symfony\Component\HttpFoundation\Response
     */
    public function display(string $title) : Response
    {
        //obtain the Doctrine repository of principles
        $principleRepository = $this->getDoctrine()->getRepository(PrincipleEntity::class);

        //by default, the form is not in select mode and no principles are required by it
        $selectMode = false;
        $principlesToSelect = [];

        switch ($title)
        {
            case 'select':

                //get titles of all principles for the select menu
                $principlesToSelect = $principleRepository->findAllTitles();

                //no principle has been selected for editing
                $principleToEdit = null;
 
                //a selection must be made whether to edit a current principle or add a new one
                $selectMode = true;

            break;

            case 'Add a new principle':

                //a principle is to be added
                $principleToEdit = null;

            break;

            default://default case is to edit principle specified by the title

                //get the specific principle to be edited on this page
                $principleToEdit = $principleRepository->findOneBy(['title' => $title]);

            break;
        }

         //create a form for selecting whether to add or edit principles, or for adding new principles or editing existing ones
         $form = $this->createForm(PrincipleType::class, $principleToEdit, [
             'select_mode' => $selectMode,
             'action' => $this->generateUrl('confirmeditprinciples', ['title' => $title], UrlGeneratorInterface::ABSOLUTE_URL),
             'method' => 'POST',
             'principles' => $principlesToSelect
        ]);

        return $this->render('editprinciples.html.twig', [
            'description' => 'A secure access point for someone to',
            'keywords' => 'principles, edit, ',
            'title' => 'Edit, add or remove the Principles Of',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/principles/edit/{title}", name="confirmeditprinciples", methods={"POST"}, defaults={"title"="select"})
     * 
     * Displays a page to confirm edits or additions to the principles.
     * Once confirmed, saves those changes to the database.
     * 
     * @param object Symfony\Component\HttpFoundation\Request $request
     * @return object Symfony\Component\HttpFoundation\Response
     */
    public function confirm(Request $request) : Response
    {
       if ('select'===$request->attributes->get('title'))//get the title portion of the URI route
        {
            //from form data sent via HTTP POST, get the choice of which principle to edit or to add a new principle
            $choice = $request->request->get('principle')['choose'];

            //send a RedirectResponse object to the display method of this controller
            return $this->redirectToRoute('editprinciples', ['title' => $choice]);
        }
        
        //create a form for previewing submitted form data before saving changes to database
        $form = $this->createForm(PrincipleType::class, null, [
            'preview_mode' => true
        ]);

        //give the HTTP request to the form
        $form->handleRequest($request);

        //if the form's submit button has been clicked
        if ($clickedButton = $form->getClickedButton()) 
        {
            if ('preview'===$clickedButton->getName())
            {   
                return $this->render('editprinciples.html.twig', [
                    'description' => 'A secure access point for someone to',
                    'keywords' => 'principles, confirm edit, ',
                    'title' => 'Preview changes made to the Principles Of',
                    'form' => $form->createView(),
                ]);
            }
            elseif ('confirm'===$clickedButton->getName())
            {
                //get the PrincipleEntity object loaded with data from the form
                $principleToSave = $form->getData();
                
                //get the Doctrine Entity Manager and save the edited or added principle to the database
                $principleDataManager = $this->getDoctrine()->getManager();
                $principleDataManager->merge($principleToSave);
                $principleDataManager->flush();
                
                return $this->render('editprinciples.html.twig', [
                    'description' => 'A secure access point for someone to',
                    'keywords' => 'principles, confirm edit, ',
                    'title' => 'Confirm that changes made to the Principles Of',
                    'message' => 'Confirmed!'
                ]);
            }
        }

    }

}
