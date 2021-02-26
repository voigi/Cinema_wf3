<?php

namespace App\Controller;

use App\Form\Type\RechercheType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController{

    /**
     * @Route("/connect" , name="connect")
     */

    public function home(Request $request){
        $nom = new Response($this->getUser()->getNom());
        $prenom = new Response($this->getUser()->getPrenom());

        return $this->render('Home/home.html.twig' , [
            'userNom' => $nom->getContent() , 
            'userPrenom' => $prenom->getContent()
            ]);
        }


    /**
     * @Route ("/" , name="home")
     */

    public function accueil(request $request){
        return $this->render('Accueil/accueil.html.twig');
    }
        
}
        
