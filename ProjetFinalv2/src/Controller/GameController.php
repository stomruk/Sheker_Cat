<?php

namespace App\Controller;

use App\Repository\GamesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    #[Route('/games', name: 'app_game_list')]
    public function index(GamesRepository $games,): Response
    {
        return $this->render('games/game_list.html.twig', [
            'games' => $games->findAll(),
        ]);
    }
}
