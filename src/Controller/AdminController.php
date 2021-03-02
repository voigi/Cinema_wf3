<?php


namespace App\Controller;

use App\Form\DeleteForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Repository\UserRepository;
use App\Repository\CommentairesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdminController extends AbstractController{

     /**
     * @var UserRepository;
     */
    private $userRepository;

    /**
     * @var CommentairesRepository;
     */
    private $commentairesRepository;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(UserRepository $userRepository, EntityManagerInterface $entityManager,  CommentairesRepository $commentairesRepository)
    {
        $this->commentairesRepository = $commentairesRepository;
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/admin" , name="admin")
     * @IsGranted("ROLE_ADMIN")
     */

    public function pageAdmin(){

        return $this->render('Admin/admin.html.twig');
    }

    /**
     * @Route("/user" , name="user_list")
     * @IsGranted("ROLE_ADMIN")
     */

    public function userList(){
        $userList = $this->userRepository->findAll();
        return $this->render('Admin/users.html.twig', [
            'userList' => $userList
            ]);
    }

    /**
     * @Route("/user/details/{id}" , name="user_details" , requirements={"id"="\d+"})
     * @IsGranted("ROLE_ADMIN")
     */

    public function userDetails(Request $request, int $id){
        $user = $this->userRepository->find($id);
        if($user === null){
            throw new NotFoundHttpException("user introuvable"); //renvoie un exception si le user demandé n'as pas été trouvé.
        }
        //utilisation d'un formulaire 'vide' pour contrer la faille CSRF
        $deleteForm = $this->createForm(DeleteForm::class);
        $deleteForm->handleRequest($request);
        if($deleteForm->isSubmitted() && $deleteForm->isValid()){
            $this->entityManager->remove($user);
            $this->entityManager->flush();
            return $this->redirectToRoute("user_list");
        }
        return $this->render('Admin/details.html.twig', ['user'=>$user, 'deleteForm' => $deleteForm->createView()]);

    }


    /**
     * @Route("/commentaire/{id}" , name="commentaire" , requirements={"id"="\d+"})
     * @IsGranted("ROLE_ADMIN")
     */

    public function removeComment(Request $request, int $id){
        $commentaire = $this->commentairesRepository->find($id);
        if($commentaire === null){
            throw new NotFoundHttpException("commentaire introuvable");
        }
        //utilisation d'un formulaire 'vide' pour contrer la faille CSRF
        $deleteForm = $this->createForm(DeleteForm::class);
        $deleteForm->handleRequest($request);
        if($deleteForm->isSubmitted() && $deleteForm->isValid()){
            $this->entityManager->remove($commentaire);
            $this->entityManager->flush();
            return $this->redirectToRoute("film_list");
        }
        return $this->render('Admin/commentDetails.html.twig', ['commentaire'=>$commentaire, 'deleteForm' => $deleteForm->createView()]);

    }

    }


    