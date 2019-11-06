<?php

namespace App\Controller;


use App\Repository\VetementRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;



class VetementsController extends AbstractController
{


    /**
     * @var VetementRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;



    public function __construct(VetementRepository $repository, ObjectManager $em)
    {
        $this-> repository = $repository;
        $this->em = $em;
    }

    /**
     * @param VetementRepository $repository
     * @return Response
     */
    public function index(VetementRepository $repository): Response
    {
        /** @var TYPE_NAME $vetements */
        $vetements = $repository->findAllNonVendu();

        return $this->render('vetements/index.html.twig', [
            "vetements" => $vetements
    ]);
    }


}
