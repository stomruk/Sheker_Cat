<?php

namespace App\Controller;

use App\Entity\Games;
use App\Entity\Notification;
use App\Entity\User;
use App\Repository\AvatarPartRepository;
use App\Repository\AvatarRepository;
use App\Repository\GamesRepository;
use App\Repository\NotificationRepository;
use App\Repository\ReviewRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Rogervila\ArrayDiffMultidimensional;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(GamesRepository $gameRepository, ReviewRepository $reviewRepository): Response
    {
        $games = $gameRepository->findAll();
        $owner = [];
        $rated = [];
        foreach ($games as $game){
            $owner[] = ['title' => $game->getName(),'id' => $game->getId() ,'owner' => count($game->getUsers()->getValues())];
            $keys = array_column($owner, 'owner');
            array_multisort($keys, SORT_DESC, $owner);
        }

        foreach ($games as $game){
            if (!empty($game->getReviews()->getValues())){
                $rated[] = ['id' => $game->getId(), 'title' => $game->getName(), 'rate' => $reviewRepository->getAverage($game->getId())];
                $keys = array_column($rated, 'rate');
                array_multisort($keys, SORT_DESC, $rated);
            }

        }
//        foreach ($reviews as $review){
//            foreach ($review as $rev){
//                $revs[] = $reviewRepository->getAverage($rev->getGame());
//            }
//        }
        dump($rated);


        return $this->render('home/index.html.twig', [
            'games' => $gameRepository->findAll(),
            'top5' => array_slice($owner, 0, 5),
            'rated' => array_slice($rated, 0, 5),
        ]);
    }

    #[Route('/cart', name: 'app_cart')]
    public function cart(SessionInterface $session): Response
    {
        dump($session->get('Cart'));
        return $this->render('home/cart.html.twig');
    }

    #[Route('/addcart/{id}', name: 'app_add_cart')]
    public function addcart($id,GamesRepository $gamesRepository,SessionInterface $session): Response
    {
        $cart = $session->get('Cart', []);
        $product = $gamesRepository->find($id);
        if ($product->getDiscount() != null){
            $newPrice = (100 - $product->getDiscount()) / 100 * $product->getPrice();
            $stringPrice = floatval($newPrice);
            $product->setPrice(number_format($stringPrice, 2, '.', ''));
        }
        $diff = [];
        $targetFriend = null;
        foreach ($this->getUser()->getFriends() as $friend){
            $friendList[] = ['id' => $friend->getFriend()->getId(), 'username' => $friend->getFriend()->getUsername()];
        }


        foreach ($product->getUsers() as $owner){
            $ownerArray[] = ['id' => $owner->getId(), 'username' => $owner->getUsername()];
        }
        if (!empty($ownerArray)){
            foreach ($friendList as $friend){
                if (!in_array($friend, $ownerArray)){
                    $diff[] = $friend;
                }
            }
        }


        if (!empty($diff)){
            $targetFriend = $diff[0];
        }


        $cartArray = ['game' => $product, 'gift' => false, 'friend' => $targetFriend, 'friendlist' => $diff, 'price' => $product->getPrice()];


        $cart[] = $cartArray;
        $session->set('Cart', $cart);
        return $this->redirectToRoute('app_cart');
    }

    #[Route('/clearcart', name: 'app_clear_cart')]
    public function clear(SessionInterface $session): Response
    {
        $session->remove('giftcart');
        $session->remove('Cart');
        $session->remove('Friends');
        return $this->redirectToRoute('app_cart');
    }

    #[Route('/gift/{index}', name: 'app_gift')]
    public function gift($index, SessionInterface $session, UserRepository $userRepository, GamesRepository $gamesRepository): Response
    {
        $cart = $session->get('Cart', []);
        $cart[$index]['gift'] = true;
        $session->set('Cart', $cart);
        return $this->redirectToRoute('app_cart');
    }

    #[Route('/ungift/{index}', name: 'app_ungift')]
    public function ungift($index, SessionInterface $session, UserRepository $userRepository): Response
    {
        $user = $userRepository->find($this->getUser());
        $cart = $session->get('Cart', []);
        $cart[$index]['gift'] = false;

        $cart[$index]['friend'] = [ 'id' => $cart[$index]['friendlist'][0]['id'], 'username' => $cart[$index]['friendlist'][0]['username']];
        $session->set('Cart', $cart);
        return $this->redirectToRoute('app_cart');
    }

    #[Route('/changeGift/{id}/{index}', name: 'app_change_gift')]
    public function changeGift($id, $index, SessionInterface $session, UserRepository $userRepository): Response
    {
        $cart = $session->get('Cart', []);
        $user = $userRepository->find($id);
        $cart[$index]['friend'] = ['id' => $user->getId(), 'username' => $user->getUsername()];
        $session->set('Cart', $cart);
        return $this->redirectToRoute('app_cart');
    }

    #[Route('/removeitem/{index}', name: 'app_remove_cart')]
    public function removeCart($index,SessionInterface $session): Response
    {
        $cart = $session->get('Cart', []);
        unset($cart[$index]);
        $session->set('Cart',$cart);
        return $this->redirectToRoute('app_cart');
    }

    #[Route('/buygame', name: 'app_buy')]
    public function buygame(SessionInterface $session, UserRepository $userRepository, GamesRepository $gamesRepository, NotificationRepository $notificationRepository, Request $request): Response
    {
        $cart = $session->get('Cart');
        foreach ($cart as $item) {
            if ($item['gift'] === true){
                $friend = $userRepository->find($item['friend']['id']);
                $notification = new Notification();
                $notification->setUser($friend);
                $notification->setFriend($this->getUser());
                $game = $gamesRepository->find($item['game']);
                $notification->setGame($game);
                $notification->setMessage('Your friend send you a gift !');
                $notificationRepository->save($notification, true);
            }
        $session->remove('Cart');
        }
        return $this->redirectToRoute('app_home');
    }


    #[Route('/notification', name: 'app_notification')]
    public function notification(NotificationRepository $notificationRepository): Response
    {
        return $this->redirectToRoute('app_cart');
    }

    #[Route('/community', name: 'app_community')]
    public function community(SessionInterface $session): Response
    {
//        $session->remove('users');
//        $session->remove('avatars');
        return $this->render('home/community.html.twig', []);
    }
    #[Route('/search/user', name: 'app_search_user')]
    public function searchgame(Request $request ,SessionInterface $session, UserRepository $userRepository, AvatarRepository $avatarRepository, AvatarPartRepository $avatarPartRepository): Response
    {
        $value = $request->get('search');
        $users = $userRepository->searchUser($value);

        $session->set('users', $users);
        return $this->redirectToRoute('app_community');
    }

}
