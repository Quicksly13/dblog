<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WebsiteMandatoriesController extends Controller
{
    /**
     * @Route("/contact", name="website_contact")
     */
    public function contact()
    {
        return $this->render('websitemandatories.html.twig', [
            'description' => 'Contact the First Dharmist',
            'keywords' => 'contact, contact the author of the Principles of Dharmism, contact the First Dharmist, who is the First Dharmist?',
            'title' => 'Contact',
            'content' => 'contact',
        ]);
    }

    /**
     * @Route("/termsandpolicy", name="website_terms")
     */
    public function terms()
    {
        return $this->render('websitemandatories.html.twig', [
            'description' => 'View the terms of use and privacy policy for this website',
            'keywords' => 'terms of use, privacy policy, ',
            'title' => 'Terms of Use',
            'content' => '',
        ]);
    }

    /**
     * @Route("/share", name="website_share")
     */
    public function share()
    {
        return $this->render('websitemandatories.html.twig', [
            'description' => 'Share the Principles of Dharmism on various online platforms',
            'keywords' => 'share the principles, share dharmism, spread dharmism',
            'title' => 'Share the Principles Of Dharmism',
            'content' => 'share',
        ]);
    }
}
