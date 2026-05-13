<?php

namespace App\Controller;

use App\Form\NewsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

final class NewsController extends AbstractController
{
    #[Route('/news', name: 'app_news')]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(NewsType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $news = $form->getData();
            $entityManager->persist($news);
            $this->addFlash('success', 'De mededeling is toegevoegd');

            return $this->redirectToRoute('app_news');
        }

        return $this->render('news/index.html.twig', [
            'form' => $form ,
        ]);
    }
}
