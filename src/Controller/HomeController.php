<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class HomeController extends AbstractController
{

    public function index(): Response  // retourne une vue en twig
    {
        return new Response($this->render('pages/home.html.twig'));
    }
}