<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class VoorwaardenController extends AbstractController
{
    #[Route('/voorwaarden', name: 'app_voorwaarden')]
    public function index(): Response
    {
        return $this->render('voorwaarden/index.html.twig', [
            'controller_name' => 'VoorwaardenController',
        ]);
    }
}
