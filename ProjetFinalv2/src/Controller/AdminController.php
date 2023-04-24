<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Games;
use App\Entity\Review;
use App\Form\CommentFormType;
use App\Form\GameType;
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

    #[Route('/admin/add/game', name: 'admin_add_game')]
    public function adminAddGame(DevelopperRepository $developperRepository, CategoryRepository $categoryRepository): Response
    {
        $developers = $developperRepository->findAll();
        $categories = $categoryRepository->findAll();
        return $this->render('admin/Admin_add_game.html.twig', [
            'developers' => $developers,
            'categories' => $categories,
        ]);
    }
    #[Route('/admin/category/list', name: 'admin_category')]
    public function adminCategory(CategoryRepository $categoryRepository): Response
    {
        return $this->render('admin/Admin_category_page.html.twig',[
            'categories' => $categoryRepository->findAll(),
        ]);
    }
    #[Route('/admin/add/category', name: 'admin_add_category')]
    public function adminAddCategory(CategoryRepository $categoryRepository, Request $request): Response
    {
        $name = $request->get('categoryInput');
        $category = new Category();
        $category->setName($name);
        $categoryRepository->save($category, true);
        return $this->redirectToRoute('admin_category');
    }

}
