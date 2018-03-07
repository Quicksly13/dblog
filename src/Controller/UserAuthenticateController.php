<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\UserEntity;
use App\Form\UserRegisterType;

class UserAuthenticateController extends Controller
{
    /**
     * @Route("/user/{authenticate}", name="user_new", methods={"POST", "GET"}, requirements={"authenticate"="register|reset"})
     * 
     * @param object Symfony\Component\HttpFoundation\Request $request
     * @param object Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface $encoder
     * @return object Symfony\Component\HttpFoundation\Response
     */
    public function register(Request $request, UserPasswordEncoderInterface $encoder) : Response
    {
        //create the form for registering new users or resetting passwords on old ones
        $form = $this->createForm(UserRegisterType::class);

        //give the HTTP request to the form
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //get the UserEntity object loaded with data from the form
            $user = $form->getData();

            //Encode the password
            $password = $encoder->encodePassword($user, $user->getPlainPassword());

            $user->setPassword($password);

            //Save the User to the database
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('edit_principles');
        }

        return $this->render('authenticateuser.html.twig', [
            'description' => 'Provides a means for users to register themselve or reset passwords',
            'keywords' => 'users, register, reset',
            'title' => 'Register new users or reset their passwords',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/user/{authenticate}", name="user_session", methods={"POST", "GET"}, requirements={"authenticate"="login"})
     * 
     * @param object Symfony\Component\HttpFoundation\Request $request
     * @return object Symfony\Component\HttpFoundation\Response
     */
    public function login () : Response
    {

        return $this->render('authenticateuser.html.twig', [
            'description' => 'Provides a means for users to register themselve or reset passwords',
            'keywords' => 'users, register, reset',
            'title' => 'Register new users or reset their passwords',
            'form' => $form->createView()
        ]);
    }
}
