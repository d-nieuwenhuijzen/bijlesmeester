<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        if ($this->isGranted('ROLE_STUDENT')){
            return $this->render('student/index.html.twig');
        }
        //wanneer je de rol 'ROLE_TEACHER' hebt wordt de teacher pagina getoond.
        if ($this->isGranted('ROLE_TEACHER')){
            return $this->render('teacher/index.html.twig');
        }

        if ($this->isGranted('ROLE_ADMIN')){
            return $this->render('admin/index.html.twig');
        }
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
