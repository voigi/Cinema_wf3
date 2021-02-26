<?php

namespace App\Controller;

use App\Form\Type\RechercheType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RechercheController extends AbstractController{


    /**
     * @Route ("/" , name="home")
     */

    public function accueil(request $request){
        $recherche = null;
        $form = $this->createForm(RechercheType::class, $recherche);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            
            return $this->redirectToRoute('list_film');
        }

        return $this->render('Accueil/accueil.html.twig' , ['recherche' => $form->createView()]);
    }


    /**
     * @Route ("/list" , name="list_film")
     */

    public function listFilm(){
        
        return $this->render('Film/list.html.twig');
    }
        
}