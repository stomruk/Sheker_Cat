<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Review;
use App\Form\CommentFormType;
use App\Form\ReviewFormType;
use App\Repository\CategoryRepository;
use App\Repository\DevelopperRepository;
use App\Repository\GamesRepository;
use App\Repository\ReviewRepository;

use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'admin')]
    public function adminIndex(): Response
    {
        return $this->render('admin/Admin_index.html.twig');
    }

    #[Route('/admin/games', name: 'admin_games')]
    public function adminGames(GamesRepository $gamesRepository): Response
    {
        return $this->render('admin/Admin_game_list.html.twig',['games' => $gamesRepository->findAll()]);
    }
    #[Route('/admin/game/{id}', name: 'admin_game')]
    public function adminGamePage($id,GamesRepository $gamesRepository, CategoryRepository $categoryRepository, DevelopperRepository $developperRepository, UserRepository $userRepository): Response
    {
        return $this->render('admin/Admin_game.html.twig',[
            'game' => $gamesRepository->find($id),
            'categories' => $categoryRepository->findAll(),
            'developers' => $developperRepository->findAll(),
            'users' => $userRepository->findAll(),
        ]);
    }

}
