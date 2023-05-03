<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Developper;
use App\Repository\CategoryRepository;
use App\Repository\DevelopperRepository;
use App\Repository\GamesRepository;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class AdminController extends AbstractController
{
    #[Route('/admin', name: 'admin')]
    public function adminIndex(): Response
    {
        if (in_array("ROLE_ADMIN", $this->getUser()->getRoles()))
        {
            return $this->render('admin/Admin_index.html.twig');
        }
        else{
            return $this->redirectToRoute('app_home');
        }
    }

    #[Route('/admin/games', name: 'admin_games')]
    public function adminGames(GamesRepository $gamesRepository): Response
    {
        if (in_array("ROLE_ADMIN", $this->getUser()->getRoles()))
        {
            return $this->render('admin/Admin_game_list.html.twig',['games' => $gamesRepository->findAll()]);
        }
        else{
            return $this->redirectToRoute('app_home');
        }
    }
    #[Route('/admin/game/{id}', name: 'admin_game')]
    public function adminGamePage($id,GamesRepository $gamesRepository, CategoryRepository $categoryRepository, DevelopperRepository $developperRepository, UserRepository $userRepository): Response
    {
        if (in_array("ROLE_ADMIN", $this->getUser()->getRoles()))
        {
            return $this->render('admin/Admin_game.html.twig',[
                'game' => $gamesRepository->find($id),
                'categories' => $categoryRepository->findAll(),
                'developers' => $developperRepository->findAll(),
                'users' => $userRepository->findAll(),
            ]);
        }
        else{
            return $this->redirectToRoute('app_home');
        }
    }

    #[Route('/admin/add/game', name: 'admin_add_game')]
    public function adminAddGame(DevelopperRepository $developperRepository, CategoryRepository $categoryRepository): Response
    {
        $developers = $developperRepository->findAll();
        $categories = $categoryRepository->findAll();

        if (in_array("ROLE_ADMIN", $this->getUser()->getRoles()))
        {
            return $this->render('admin/Admin_add_game.html.twig', [
                'developers' => $developers,
                'categories' => $categories,
            ]);
        }
        else{
            return $this->redirectToRoute('app_home');
        }
    }
    #[Route('/admin/category/list', name: 'admin_category')]
    public function adminCategory(CategoryRepository $categoryRepository): Response
    {
        if (in_array("ROLE_ADMIN", $this->getUser()->getRoles()))
        {
            return $this->render('admin/Admin_category_page.html.twig',[
                'categories' => $categoryRepository->findAll(),
            ]);
        }
        else{
            return $this->redirectToRoute('app_home');
        }
    }
    #[Route('/admin/add/category', name: 'admin_add_category')]
    public function adminAddCategory(CategoryRepository $categoryRepository, Request $request): Response
    {
        $name = $request->get('categoryInput');
        $category = new Category();
        $category->setName($name);
        $categoryRepository->save($category, true);
        if (in_array("ROLE_ADMIN", $this->getUser()->getRoles()))
        {
            return $this->redirectToRoute('admin_category');
        }
        else{
            return $this->redirectToRoute('app_home');
        }
    }
    #[Route('/admin/delete/category/{id}', name: 'admin_delete_category')]
    public function adminDeleteCategory(CategoryRepository $categoryRepository, $id): Response
    {
        $category = $categoryRepository->find($id);
        $categoryRepository->remove($category, true);
        if (in_array("ROLE_ADMIN", $this->getUser()->getRoles()))
        {
            return $this->redirectToRoute('admin_category');
        }
        else{
            return $this->redirectToRoute('app_home');
        }
    }
    #[Route('/admin/developer/list', name: 'admin_developer')]
    public function adminDeveloper(DevelopperRepository $developperRepository): Response
    {
        if (in_array("ROLE_ADMIN", $this->getUser()->getRoles()))
        {
            return $this->render('admin/Admin_developer_page.html.twig',[
                'developers' => $developperRepository->findAll(),
            ]);
        }
        else{
            return $this->redirectToRoute('app_home');
        }
    }
    #[Route('/admin/add/developer', name: 'admin_add_developer')]
    public function adminAddDeveloper(DevelopperRepository $developperRepository, Request $request): Response
    {
        $name = $request->get('developerInput');
        $developer = new Developper();
        $developer->setName($name);
        $developperRepository->save($developer, true);
        if (in_array("ROLE_ADMIN", $this->getUser()->getRoles()))
        {
            return $this->redirectToRoute('admin_developer');
        }
        else{
            return $this->redirectToRoute('app_home');
        }
    }
    #[Route('/admin/delete/developer/{id}', name: 'admin_delete_developer')]
    public function adminDeleteDeveloper(DevelopperRepository $developperRepository, $id): Response
    {
        $developer = $developperRepository->find($id);
        $developperRepository->remove($developer, true);
        if (in_array("ROLE_ADMIN", $this->getUser()->getRoles()))
        {
            return $this->redirectToRoute('admin_developer');
        }
        else{
            return $this->redirectToRoute('app_home');
        }
    }

}
