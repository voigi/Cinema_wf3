<?php

namespace App\Controller;


use Symfony\Component\HttpClient\HttpClient;
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
        $form = $this->createForm(RechercheType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $searchTerm = $form->get('recherche')->getData();
           return $this->redirectToRoute('list_film' , ['search' => $searchTerm]);
        }

        return $this->render('Accueil/accueil.html.twig' , ['recherche' => $form->createView()]);
    }

    /**
     * @Route ("/list" , name="list_film")
     */

    public function listFilm(){

        $httpClient = HttpClient::create();
        $response = $httpClient->request(
            'GET', 
            'https://api.themoviedb.org/3/search/movie?api_key=b1a700d2ca02d17dc69cec6dd235dc6e&query=batman&language=fr'
        );

        

        $statusCode = $response->getStatusCode();
        /*echo $statusCode . "\n";*/

        $contentType = $response->getHeaders()['content-type'][0];
        /*echo $contentType . "\n";*/

        $content = $response->getContent();
        /*echo $content . "\n";*/


        /* Convertir un objet en tableau */
        $tableau = json_decode($content, true); //!!!!!!!
        

        /* Essai de manipulation tableau */
        


        


        return $this->render('Film/list.html.twig' , ['content' => $tableau]);
        
    }
        
}