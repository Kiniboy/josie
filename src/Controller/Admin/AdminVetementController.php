<?php
namespace App\Controller\Admin;

use App\Entity\Vetement;
use App\Form\VetementType;
use App\Repository\VetementRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminVetementController extends AbstractController
{
    /**
     * @var VetementRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;

    /**
     * AdminVetementController constructor.
     * @param VetementRepository $repository
     * @param ObjectManager $em
     */
    public function __construct(VetementRepository $repository, ObjectManager $em)
    {

        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        /** @var TYPE_NAME $vetements */
        $vetements = $this->repository->findAll();
        return $this->render('admin/vetements/index.html.twig', compact('vetements'));

    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function new(Request $request){  // creer un vetement
        $vetement = new Vetement();
        $form = $this->createForm(VetementType::class, $vetement); // creation du formulaire
        $form->handleRequest($request); // traiter la requete, cherche dans l'objet vetement les setters et change les parametres

        if ($form->isSubmitted() && $form->isValid()){
            $this->em->persist($vetement);
            $this->em->flush();
            $this->addFlash('success', 'L\'article a été créé avec succès ');  // message flash de symfony envoyer en session pour commenter une action
            return $this->redirectToRoute('vetements');

        }
        return $this->render('admin/vetements/new.html.twig', [  // envoie à la vue
            'vetement'=> $vetement,
            'form' => $form->createView()  // fonction symfony qui creait la vue
        ]);


    }

    /**
     * @param Vetement $vetement
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function edit(Vetement $vetement, Request $request){

        $form = $this->createForm(VetementType::class, $vetement); // creation du formulaire
        $form->handleRequest($request); // traiter la requete, cherche dans l'objet vetement les setters et change les parametres

        if ($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success', 'L\'article a été modifié');
            return $this->redirectToRoute('vetements');

        }
        return $this->render('admin/vetements/edit.html.twig', [  // envoie à la vue
            'vetement'=> $vetement,
            'form' => $form->createView()  // fonction symfony qui creait la vue
        ]);

    }

    /**
     * @param Vetement $vetement
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(Vetement $vetement){
        $this->em->remove($vetement);
        $this->em->flush(); // apporte les informations à la base de données
        $this->addFlash('success', 'L\'article a été supprimé');
        return $this->redirectToRoute('vetements');


    }

}