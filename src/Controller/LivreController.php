<?php

namespace App\Controller;

use App\Repository\LivreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LivreController extends AbstractController
{
    #[Route('/livres', name: 'app_liste_livres')]
    public function index(LivreRepository $livreRepository): Response
    {
        $livres = $livreRepository->findAll();
        return $this->render('livre/liste_livres.html.twig', ['livres' => $livres]);
    }
}
