<?php

namespace App\Controller;


use App\Entity\Vetement;
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




    public function __construct(VetementRepository $repository, ObjectManager $em) // fonction constructeur qui instancie le répository
    {
        $this-> repository = $repository;
        $this->em = $em;
    }

    /**
     * @param VetementRepository $repository
     * @return Response
     */
    public function index(VetementRepository $repository): Response    // fonction index
    {
        /** @var TYPE_NAME $vetements */
        $vetements = $repository->findAllNonVendu();  // récupère les articles non vendu

        return $this->render('vetements/index.html.twig', [   // retourne une vue en twig
            "vetements" => $vetements
    ]);
    }

    /**
     * @param VetementRepository $repository
     * @param int $id
     * @return Response
     */
    public function details(VetementRepository $repository, int $id): Response  // voir le détail d'un article
    {
        $vetement = $repository->find($id);

        return $this->render('vetements/details.html.twig', [
            "vetement" => $vetement
        ]);
    }


}
