<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class AdminController extends AbstractController{

    /**
     * @Route("/admin" , name="admin")
     * @IsGranted("ROLE_ADMIN")
     */

    public function pageAdmin(){

        return $this->render('Admin/admin.html.twig');
    }

}

    