<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WebsitePolicyController extends Controller
{
    /**
     * @Route("/website/policy", name="website_policy")
     */
    public function index()
    {
        return $this->render('website_policy/index.html.twig', [
            'controller_name' => 'WebsitePolicyController',
        ]);
    }
}
