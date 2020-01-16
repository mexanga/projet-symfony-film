<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StaticController extends AbstractController
{

    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('static/home.html.twig', [
            'controller_name' => 'StaticController',
            'page_title'  => 'Un titre'
        ]);
    }
}
