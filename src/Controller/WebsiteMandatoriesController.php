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
            'description' => 'A secure access point for someone to',
            'keywords' => 'principles, confirm edit, ',
            'title' => 'Preview changes made to the Principles Of',
            'content' => 'contact',
        ]);
    }

    /**
     * @Route("/termsandpolicy", name="website_terms")
     */
    public function terms()
    {
        return $this->render('websitemandatories.html.twig', [
            'description' => 'A secure access point for someone to',
            'keywords' => 'principles, confirm edit, ',
            'title' => 'Preview changes made to the Principles Of',
            'content' => '',
        ]);
    }
}
