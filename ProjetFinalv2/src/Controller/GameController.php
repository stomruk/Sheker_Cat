<?php

namespace App\Controller;

use App\Entity\Games;
use App\Repository\CategoryRepository;
use App\Repository\GamesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    #[Route('/games', name: 'app_game_list')]
    public function index(GamesRepository $gamesRepo, CategoryRepository $categoryRepository, SessionInterface $session): Response
    {
        $filteredGames = [];
        $filter = $session->get('Filter', []);
        $games = $gamesRepo->findAll();

        if (empty($session->get('Search'))){

            foreach ($games as $game) {
                $toAdd  = true;

                // On récupère tous les IDs des catégories présentes sur notre jeu.
                $categIds = [];
                foreach ($game->getCategories() as $gameCateg) {
                    $categIds[] = $gameCateg->getId();
                }

                // si il y a plus de filtres qu'il n'y a de catégories pour le jeu
                // on ne le garde pas
                if (count($filter) > count($categIds)) continue;

                // on trouve la différence entre les filtre et les catégories du jeu
                $diff = array_diff($filter, $categIds);

                foreach ($filter as $gameFilter) {
                    // si un des filtre n'est pas présent sur le jeu
                    // on ne le garde pas
                    if (in_array($gameFilter, $diff)) {
                        $toAdd = false;
                        break;
                    }
                }

                if ($toAdd) {
                    $filteredGames[] = $game;
                }
            }
        }
        else{
            $filteredGames = $session->get('Search');
        }




        //dump($categoryRepository->findBy(['id' => 2, 'id'=> 4]));


        return $this->render('games/game_list.html.twig', [
            'games' => $filteredGames,
            'categories' => $categoryRepository->findAll(),
        ]);
    }
    #[Route('/game/{id}', name: 'app_game_page')]
    public function game_page($id, Games $game, GamesRepository $games,): Response
    {
        $game = $games->find($id);
        return $this->render('games/game_page.html.twig', [
            'game' => $game,
        ]);
    }

    #[Route('/showgames', name: 'app_show_games')]
    public function showgames(SessionInterface $session): Response
    {
        $session->remove('Filter');
        $session->remove('Search');
        return $this->redirectToRoute('app_game_list');
    }



    #[Route('/games/{cat}', name: 'app_filter_game')]
    public function filterGame($cat, SessionInterface $session, CategoryRepository $categoryRepository, GamesRepository $gamesRepository): Response
    {
        $filter = $session->get('Filter', []);
        $filter[] = $cat;
        $session->set('Filter', $filter);
        return $this->redirectToRoute('app_game_list');
    }

    #[Route('/removegames/{cat}', name: 'app_remove_filter')]
    public function removefilter(string $cat, SessionInterface $session): Response
    {
        $filter = $session->get('Filter', []);
        $filter = array_filter($filter, function(string $currentFilter) use ($cat) {
            return $cat !== $currentFilter;
        });
        unset($filter[$cat]);
        $session->set('Filter', $filter);
        return $this->redirectToRoute('app_game_list');
    }
    #[Route('/clearfilter', name: 'app_clear_filter')]
    public function clearfilter(SessionInterface $session): Response
    {
        $session->remove('Filter');
        $session->remove('Search');
        return $this->redirectToRoute('app_game_list');
    }

    #[Route('/filter/{cat}', name: 'app_filter_button')]
    public function filterbutton($cat, SessionInterface $session, CategoryRepository $categoryRepository, GamesRepository $gamesRepository): Response
    {
        $session->remove('Filter');
        $filter[] = $cat;
        $session->set('Filter', $filter);

        return $this->redirectToRoute('app_game_list');
    }

    #[Route('/search', name: 'app_search')]
    public function searchgame(Request $request ,SessionInterface $session, GamesRepository $gamesRepository): Response
    {
        $session->remove('Filter');
        $name = $request->get('search');
        $session->set('Search', $gamesRepository->searchGame($name));
        return $this->redirectToRoute('app_game_list');
    }


}
