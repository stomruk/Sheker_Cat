<?php

namespace App\Controller;

use App\Entity\CodePromo;
use App\Entity\Comment;
use App\Entity\Developper;
use App\Entity\Games;
use App\Entity\Images;
use App\Entity\Review;
use App\Form\CommentFormType;
use App\Form\ReviewFormType;
use App\Repository\CategoryRepository;
use App\Repository\CodePromoRepository;
use App\Repository\DevelopperRepository;
use App\Repository\GamesRepository;
use App\Repository\ImagesRepository;
use App\Repository\ReviewRepository;

use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\Translation\t;

class AdminGameController extends AbstractController
{

    #[Route('/admin/game/change/title/{id}', name: 'admin_change_game_title')]
    public function changeTitle($id, GamesRepository $gamesRepository, Request $request): Response
    {
        $game = $gamesRepository->find($id);
        $title = $request->get('title');
        $game->setName($title);

        $gamesRepository->save($game, true);
        return $this->redirectToRoute('admin_game',['id' => $game->getId()]);
    }

    #[Route('/admin/game/change/description/{id}', name: 'admin_change_game_description')]
    public function changeDescription($id, GamesRepository $gamesRepository, Request $request): Response
    {
        $game = $gamesRepository->find($id);
        $description = $request->get('description');
        $game->setDescription($description);

        $gamesRepository->save($game, true);
        return $this->redirectToRoute('admin_game',['id' => $game->getId()]);
    }

    #[Route('/admin/game/change/cover/{id}', name: 'admin_change_game_cover')]
    public function changeCover($id, GamesRepository $gamesRepository, Request $request): Response
    {
        $game = $gamesRepository->find($id);
        $cover = $request->get('cover');
        $game->setCover($cover);

        $gamesRepository->save($game, true);
        return $this->redirectToRoute('admin_game',['id' => $game->getId()]);
    }

    #[Route('/admin/game/change/price/{id}', name: 'admin_change_game_price')]
    public function changePrice($id, GamesRepository $gamesRepository, Request $request): Response
    {
        $game = $gamesRepository->find($id);
        $price = $request->get('price');
        $game->setPrice($price);

        $gamesRepository->save($game, true);
        return $this->redirectToRoute('admin_game',['id' => $game->getId()]);
    }

    #[Route('/admin/add/game/image/{id}', name: 'admin_add_game_image')]
    public function addImage($id, GamesRepository $gamesRepository, Request $request, ImagesRepository $imagesRepository): Response
    {
        $game = $gamesRepository->find($id);
        $image = $request->get('image');

        $newImage = new Images();
        $newImage->setSource($image);
        $newImage->setGame($game);

        $imagesRepository->save($newImage, true);
        return $this->redirectToRoute('admin_game',['id' => $game->getId()]);
    }

    #[Route('/admin/delete/game/image/{id}', name: 'admin_delete_game_image')]
    public function deleteImage($id, ImagesRepository $imagesRepository): Response
    {
        $image = $imagesRepository->find($id);
        $game = $image->getGame();

        $imagesRepository->remove($image, true);

        return $this->redirectToRoute('admin_game',['id' => $game->getId()]);
    }

    #[Route('/admin/game/add/category/{id}', name: 'admin_add_game_category')]
    public function addCategory($id, GamesRepository $gamesRepository, Request $request, CategoryRepository $categoryRepository): Response
    {
        $game = $gamesRepository->find($id);
        $category = $categoryRepository->find($request->get('category'));
        $game->addCategory($category);

        $gamesRepository->save($game, true);
        return $this->redirectToRoute('admin_game',['id' => $game->getId()]);
    }

    #[Route('/admin/delete/game/category/{id}/{gameId}', name: 'admin_delete_game_category')]
    public function deleteCategory($id, $gameId, GamesRepository $gamesRepository, CategoryRepository $categoryRepository): Response
    {
        $game = $gamesRepository->find($gameId);
        $category = $categoryRepository->find($id);

        $game->removeCategory($category);
        $gamesRepository->save($game, true);

        return $this->redirectToRoute('admin_game',['id' => $game->getId()]);
    }

    #[Route('/admin/game/change/date/{id}', name: 'admin_change_game_date')]
    public function changeDate($id, GamesRepository $gamesRepository, Request $request): Response
    {
        $game = $gamesRepository->find($id);
        $date = $request->get('date');
        $game->setDate($date);

        $gamesRepository->save($game, true);
        return $this->redirectToRoute('admin_game',['id' => $game->getId()]);
    }


    // IL FAUT CORRIGER ÇA
    #[Route('/admin/game/change/developer/{id}', name: 'admin_change_game_developer')]
    public function changeDeveloper($id, GamesRepository $gamesRepository, Request $request): Response
    {
        $game = $gamesRepository->find($id);
        $developer = $request->get('developer');


        $gamesRepository->save($game, true);
        return $this->redirectToRoute('admin_game',['id' => $game->getId()]);
    }

    #[Route('/admin/game/change/code/{id}/{gameId}', name: 'admin_change_game_code')]
    public function changeCode($id, $gameId,GamesRepository $gamesRepository, CodePromoRepository $codePromoRepository, Request $request): Response
    {
        $codePromo = $codePromoRepository->find($id);
        $game = $gamesRepository->find($gameId);

        $code = $request->get('code');
        $discount = $request->get('discount');

        $codePromo->setCode($code);
        $codePromo->setDiscount($discount);
        $codePromoRepository->save($codePromo, true);

        return $this->redirectToRoute('admin_game',['id' => $game->getId()]);
    }

    #[Route('/admin/game/add/code/{id}', name: 'admin_add_game_code')]
    public function addGameCode($id, GamesRepository $gamesRepository, Request $request,CodePromoRepository $codePromoRepository): Response
    {
        $game = $gamesRepository->find($id);
        $code = new CodePromo();

        $code->setCode($request->get('code'));
        $code->setDiscount($request->get('discount'));
        $game->addCodePromo($code);

        $codePromoRepository->save($code, true);
        $gamesRepository->save($game, true);

        return $this->redirectToRoute('admin_game',['id' => $game->getId()]);
    }

    #[Route('/admin/game/delete/code/{id}/{gameId}', name: 'admin_delete_game_code')]
    public function deleteGameCode($id, $gameId,GamesRepository $gamesRepository, CodePromoRepository $codePromoRepository): Response
    {
        $code = $codePromoRepository->find($id);
        $game = $gamesRepository->find($gameId);

        $code->removeGame($game);
        $codePromoRepository->save($code, true);

        return $this->redirectToRoute('admin_game',['id' => $game->getId()]);
    }

    #[Route('/admin/delete/code/{id}/{gameId}', name: 'admin_delete_code')]
    public function deleteCode($id, $gameId,GamesRepository $gamesRepository, CodePromoRepository $codePromoRepository): Response
    {
        $code = $codePromoRepository->find($id);
        $game = $gamesRepository->find($gameId);

        $codePromoRepository->remove($code, true);
        return $this->redirectToRoute('admin_game',['id' => $game->getId()]);
    }

    #[Route('/admin/game/change/sale/{id}', name: 'admin_change_game_sale')]
    public function changeSale($id, GamesRepository $gamesRepository, Request $request): Response
    {
        $game = $gamesRepository->find($id);
        $sale = $request->get('sale');

        if ($sale == 0){
            $game->setDiscount(null);
        }
        else{
            $game->setDiscount($sale);
        }

        $gamesRepository->save($game, true);

        return $this->redirectToRoute('admin_game',['id' => $game->getId()]);
    }

    #[Route('/admin/add/new/game', name: 'admin_add_new_game')]
    public function addnewGame(GamesRepository $gamesRepository, Request $request, SessionInterface $session, DevelopperRepository $developperRepository,
    CategoryRepository $categoryRepository, ImagesRepository $imagesRepository): Response
    {
        $title = $request->get('title');
        $description = $request->get('description');
        $cover = $request->get('cover');
        $price = $request->get('price');
        $date = $request->get('date');
        $sale = $request->get('sale');
        $devID = $request->get('developer');
        $categoryID = $request->get('category');
        $categoryID2 = $request->get('category2');
        $categoryID3 = $request->get('category3');
        $imageSource = $request->get('image');
        $imageSource2 = $request->get('image2');
        $imageSource3 = $request->get('image3');
        $imageSource4 = $request->get('image4');

        $game = new Games();
        $game->setName($title);
        $game->setDescription($description);
        $game->setCover($cover);
        $game->setPrice($price);
        $game->setDate($date);
        $game->setDiscount($sale);
        $developer = $developperRepository->find($devID);
        $game->addDevelopper($developer);
        $category = $categoryRepository->find($categoryID);
        $category2 = $categoryRepository->find($categoryID2);
        $category3 = $categoryRepository->find($categoryID3);
        $game->addCategory($category);
        $game->addCategory($category2);
        $game->addCategory($category3);

        $gamesRepository->save($game, true);

        $image = new Images();
        $image->setSource($imageSource);
        $image->setGame($game);
        $game->addImage($image);
        $imagesRepository->save($image, true);

        $image2 = new Images();
        $image2->setSource($imageSource2);
        $image2->setGame($game);
        $game->addImage($image2);
        $imagesRepository->save($image2, true);

        $image3 = new Images();
        $image3->setSource($imageSource3);
        $image3->setGame($game);
        $game->addImage($image3);
        $imagesRepository->save($image3, true);

        $image4 = new Images();
        $image4->setSource($imageSource4);
        $image4->setGame($game);
        $game->addImage($image4);
        $imagesRepository->save($image4, true);

        $gamesRepository->save($game, true);
        return $this->redirectToRoute('app_home');
    }
}