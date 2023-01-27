<?php

namespace App\Controller;

use App\Entity\Games;
use App\Entity\Notification;
use App\Entity\User;
use App\Repository\GamesRepository;
use App\Repository\NotificationRepository;
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
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/cart', name: 'app_cart')]
    public function cart(UserRepository $userRepository): Response
    {
        $user = $userRepository->find($this->getUser());

        return $this->render('home/cart.html.twig');
    }

    #[Route('/addcart/{id}', name: 'app_add_cart')]
    public function addcart($id,GamesRepository $gamesRepository,SessionInterface $session): Response
    {
        $cart = $session->get('Cart', []);
        $product = $gamesRepository->find($id);
        $cartArray = ['game' => $product, 'gift' => false, 'friend' => 'none', 'friendlist' => 'none'];

        foreach ($this->getUser()->getFriends() as $friend){
            $friendList[] = ['id' => $friend->getFriend()->getId(), 'username' => $friend->getFriend()->getUsername()];
        }


        foreach ($product->getUsers() as $owner){
            $ownerArray[] = ['id' => $owner->getId(), 'username' => $owner->getUsername()];
        }
        foreach ($friendList as $friend){
            if (!in_array($friend, $ownerArray)){
                $diff[] = $friend;
            }
        }

        $cartArray = ['game' => $product, 'gift' => false, 'friend' => $diff[0], 'friendlist' => $diff];


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
        $cart[$index]['friend'] = 'none';
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

        /*
        $cart = $session->get('Cart');
        $user = $userRepository->find($this->getUser());
        foreach ($cart as $gameID){
            $game = $gamesRepository->find($gameID['game']);
            $user->addGame($game);
        }
        $userRepository->save($user, true);
        $session->remove('Cart');
        */
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

/*
    #[Route('/buygame', name: 'app_buy')]
    public function buygame(SessionInterface $session, UserRepository $userRepository, GamesRepository $gamesRepository, NotificationRepository $notificationRepository, Request $request): Response
    {
        $gift = $request->get('gift');
        $friendid = $request->get('target');
        $friend = $userRepository->find($friendid);
        $cart = $session->get('Cart');
        if ($gift){
            $notification = new Notification();
            foreach ($cart as $gameid){
                $game = $gamesRepository->find($gameid);
                $notification->setUser($friend);
                $notification->setFriend($this->getUser());
                $notification->setGame($game);
                $notification->setMessage('You received a gift !');

                $notificationRepository->save($notification, true);
            }
        }
        else{
            $gift = 'ezaazeezaza';
        }
        return $this->render('test.html.twig', [
            'yest' => 'HomeController',
            'gift' => $gift
        ]);
    }
*/

    #[Route('/notification', name: 'app_notification')]
    public function notification(NotificationRepository $notificationRepository): Response
    {
        return $this->redirectToRoute('app_cart');
    }

}
