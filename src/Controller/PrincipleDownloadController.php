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
            'description' => 'A page to download the Principles Of Dharmism',
            'keywords' => 'principles, download, ',
            'title' => 'Download the Principles Of Dharmism',
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
        //get the absolute directory path to the src folder
        $appPath = $this->container->getParameter('kernel.root_dir');

        //get the relative directory path to the file to be downloaded
        $filePath = realpath($appPath . '/../resources/PrinciplesOfDharmism.pdf');

        //send a BinaryFileResponse to download the file
        return $this->file($filePath);

    }
}
