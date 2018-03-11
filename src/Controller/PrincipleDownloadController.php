<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class PrincipleDownloadController extends Controller
{
    /**
     * @Route("/principles/download", name="view_download_principles", methods={"GET"})
     * 
     * @return object Symfony\Component\HttpFoundation\Response
     */
    public function display(): Response
    {
        return $this->render('principles/downloadprinciples.html.twig', [
            'description' => 'A page to download the',
            'keywords' => 'principles, download, ',
            'title' => 'Download the Principles Of',
            'message' => 'download'
        ]);
    }

    /**
     * @Route("/principles/downloadnow", name="download_principles", methods={"GET"})
     *
     * @return object Symfony\Component\HttpFoundation\Response
     */
    public function transfer(): Response
    {
        $appPath = $this->container->getParameter('kernel.root_dir');
        $webPath = realpath($appPath . '/../assets/tale0.pdf');

        return $this->file($webPath);

    }
}
