<?php


namespace App\Controller;

use App\Entity\Commentaires;
use App\Entity\Film;
use App\Form\DeleteForm;
use App\Form\FilmType;
use App\Form\Type\CommentaireType;
use App\Repository\FilmRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class FilmController extends AbstractController
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var FilmRepository
     */
    private $filmRepository;

    public function __construct(EntityManagerInterface $entityManager, FilmRepository $filmRepository)
    {
        $this->entityManager = $entityManager;
        $this->filmRepository = $filmRepository;
    }

    /**
     * @Route("/film/{id}", name="film_details", requirements={"id"="\d+"})
     */
    public function getDetails(Request $request, int $id){
        $film = $this->filmRepository->find($id);

        $commentaire = new Commentaires();
        $commentaire->setFilm($film);

        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->entityManager->persist($commentaire);
            $this->entityManager->flush();
            return $this->redirectToRoute('film_details', ['id'=>$id]);
        }

        if($film === null){
            throw new NotFoundHttpException("film introuvable"); //renvoie un exception si le film demandé n'as pas été trouvé.
        }
        $deleteForm = $this->createForm(DeleteForm::class);
        $deleteForm->handleRequest($request);
        if($deleteForm->isSubmitted() && $deleteForm->isValid()){
            $this->entityManager->remove($film);
            $this->entityManager->flush();
            return $this->redirectToRoute("film_list");
        }
        
        return $this->render('Film/details.html.twig', [
            'film'=>$film, 
            'formulaire' => $form->createView(),
            'deleteForm' => $deleteForm->createView()
            ]);

    }

    /**
     * @Route("film/create", name="create_film")
     * @IsGranted("ROLE_ADMIN")
     */
        public function create(Request $request){
            $film = new Film(); // l'entité qu'on va éditer
            $form = $this->createForm(FilmType::class, $film); //création du formulaire
    
            $form->handleRequest($request); //liaison du formulaire et de la requete HTTP
            if($form->isSubmitted() && $form->isValid()){
                $this->entityManager->persist($film);
                $this->entityManager->flush();
                return $this->redirectToRoute('film_details', [ 'id' => $film->getId() ]); //redirection vers le détail
            }
            return $this->render('Film/create.html.twig', ['formulaire' => $form->createView()]);
        }

    /**
     * @Route("/film/", name="film_list")
     */
        public function getList(Request $request){
            $filmList = $this->filmRepository->findAll();
            return $this->render('Film/list.html.twig', ['filmList' => $filmList]);
        }

}