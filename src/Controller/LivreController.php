<?php

namespace App\Controller;

use App\Entity\Livre;
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

    #[Route('/livres/{id}', name: 'app_liste_livre')]
    public function show(Livre $livre): Response
    {
        return $this->render('livre/show.html.twig', ['livre' => $livre]);
    }
}
