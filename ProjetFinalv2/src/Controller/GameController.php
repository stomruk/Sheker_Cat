<?php

namespace App\Controller;

use App\Entity\Games;
use App\Manager\GameManager;
use App\Repository\CategoryRepository;
use App\Repository\CodePromoRepository;
use App\Repository\GamesRepository;
use App\Repository\ReviewRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    private GameManager $gameManager;

    public function __construct(GameManager $gameManager)
    {
        $this->gameManager = $gameManager;
    }

    #[Route('/games', name: 'app_game_list')]
    public function index(GamesRepository $gamesRepo, CategoryRepository $categoryRepository, SessionInterface $session): Response
    {
        $filteredGames = [];
        $filter = $session->get('Filter', []);
        $games = $gamesRepo->findAll();
        if (empty($session->get('Search'))){

            foreach ($games as $game) {
                if ($this->gameManager->hasCategories($game, $filter)) {
                    $filteredGames[] = $game;
                }
//                if ($game->getDiscount() != null){
//                    $game->setPrice($this->gameManager->calculatePrice($game->getPrice(), $game->getDiscount()));
//                }
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
    public function game_page($id, GamesRepository $games,ReviewRepository $reviewRepository): Response
    {
        $game = $games->find($id);
        $avg = null;
        if (!empty($game->getReviews()->getValues())){
            $avg = $reviewRepository->getAverage($game->getId());
        }

        return $this->render('games/game_page.html.twig', [
            'game' => $game,
            'avg' => $avg
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
        $session->remove('Cart');
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

    #[Route('/search/game', name: 'app_search_game')]
    public function searchgame(Request $request ,SessionInterface $session, GamesRepository $gamesRepository): Response
    {
        $session->remove('Filter');
        $name = $request->get('search');
        $session->set('Search', $gamesRepository->searchGame($name));
        return $this->redirectToRoute('app_game_list');
    }
    #[Route('/discount', name: 'app_discount')]
    public function searchdiscount(Request $request, CodePromoRepository $codePromoRepository, SessionInterface $session, GamesRepository $gamesRepository): Response
    {
        $discount = $request->get('code');
        $discountCode = $codePromoRepository->findBy(['code' => $discount]);
        $discountedGame = $discountCode[0]->getGame();

        $cart = $session->get('Cart');
        foreach ($cart as $index=>$item){
            dump($item['game']);
            dump($discountedGame->getValues()[0]);
            if ($item['game']->getId() === $discountedGame->getValues()[0]->getId()){
                $cart[$index]['price'] = $this->gameManager->calculatePrice($item['game']->getPrice(),$discountCode[0]->getDiscount()) - 0.01;
            }
        }
        $session->set('Cart', $cart);
        return $this->redirectToRoute('app_cart');
    }

}




/*
 *   filter[2,3]
 *
 *   test[
 *   0 =>[
 *      name: ark
 *      categories: [1,2,3]
 * ]
 *   1 => [
 *  *   name: payday
 *      categories: [2,4,5]
 * ]
 *
 *
 *
 *
 *
 *
 */








