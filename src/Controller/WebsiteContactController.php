<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WebsiteContactController extends Controller
{
    /**
     * @Route("/website/contact", name="website_contact")
     */
    public function index()
    {
        return $this->render('website_contact/index.html.twig', [
            'controller_name' => 'WebsiteContactController',
        ]);
    }
}
