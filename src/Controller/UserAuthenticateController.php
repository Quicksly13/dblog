<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\UserEntity;
use App\Form\UserRegisterType;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Form\UserLoginType;

class UserAuthenticateController extends Controller
{
    /**
     * @Route("/user/login", name="authenticate_user", methods={"POST", "GET"}, schemes={"https"})
     * 
     * @param object Symfony\Component\HttpFoundation\Request $request
     * @param object Symfony\Component\Security\Http\Authentication\AuthenticationUtils $authUtils
     * @return object Symfony\Component\HttpFoundation\Response
     */
    public function login (Request $request, AuthenticationUtils $authUtils): Response
    {
        // get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();
        
        //last username entered by the user
        $lastUsername = $authUtils->getLastUsername();

        //create the form for logging users into their accounts
        $form = $this->createForm(UserLoginType::class);

        return $this->render('authenticateuser.html.twig', [
            'description' => 'Provides a means for registered users to log into their accounts',
            'keywords' => 'user, login, log in, authenticate, security, access',
            'title' => 'Log in existing users',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/user/{fresh}", name="freshen_user", methods={"POST", "GET"}, requirements={"fresh"="register|reset"}, defaults={"fresh"="register"}, schemes={"https"})
     * 
     * @param object Symfony\Component\HttpFoundation\Request $request
     * @param object Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface $encoder
     * @return object Symfony\Component\HttpFoundation\Response
     */
    public function register(Request $request, UserPasswordEncoderInterface $encoder): Response
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
            $entityManager->merge($user);
            $entityManager->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('edit_principles');
        }

        return $this->render('authenticateuser.html.twig', [
            'description' => 'Provides a means for users to register themselves or reset passwords',
            'keywords' => 'users, register, reset',
            'title' => 'Register new users or reset their passwords',
            'form' => $form->createView()
        ]);
    }

}
