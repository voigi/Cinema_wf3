<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Form\Type\CommentaireType;
use App\Repository\CommentaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentaireController extends AbstractController{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var CommentaireRepository
     */
    private $commentaireRepository;


    public function __construct(EntityManagerInterface $entityManager, CommentaireRepository $commentaireRepository)
    {
        $this->entityManager = $entityManager;
        $this->commentaireRepository = $commentaireRepository;


    }


    /**
     * @Route("/details", name="details_film")
     * @IsGranted("ROLE_USER")
     */
    
     public function createCommentaire(Request $request){
        $commentaire = new Commentaire();
        $user = $this->getUser();
        $form = $this->createForm(CommentaireType::class , $commentaire);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $this->entityManager->persist($commentaire);
            $this->entityManager->flush();
        }
        return $this->render('Film/details.html.twig' , [
            'commentaireForm' => $form->createView()
    
            ]);
    }


}
