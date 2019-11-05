<?php

namespace App\Controller;

use App\Entity\Vetement;
use App\Repository\VetementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;



class VetementsController extends AbstractController
{


    /**
     * @var VetementRepository
     */
    private $repository;

    public function __construct(VetementRepository $repository)
    {
        $this-> repository = $repository;
    }

    public function index(): Response
    {
        /** recuperer les objets vetements et les envoyés à la vue */
        $this->repository->findAllNonVendu();
        return $this->render('vetements/index.html.twig');
    }


}
