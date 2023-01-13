<?php

namespace App\Controller;

use App\Entity\Games;
use App\Entity\Notification;
use App\Entity\User;
use App\Repository\GamesRepository;
use App\Repository\NotificationRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
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
        return $this->render('home/cart.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/addcart/{id}', name: 'app_add_cart')]
    public function addcart($id,GamesRepository $gamesRepository,SessionInterface $session): Response
    {
        $cart = $session->get('Cart', []);
        $anotherArray = $session->get('giftcart', []);
        $product = $gamesRepository->find($id);
        $cart[] = $product;
        $testArray = ['game' => $product, 'gift' => false, 'friend' => 'none'];
        $anotherArray[] = $testArray;
        $session->set('Cart', $cart);
        $session->set('giftcart', $anotherArray);
        return $this->redirectToRoute('app_cart');
    }

    #[Route('/clearcart', name: 'app_clear_cart')]
    public function clear(SessionInterface $session): Response
    {
        $session->remove('giftcart');
        $session->remove('Cart');
        return $this->redirectToRoute('app_cart');
    }

    #[Route('/gift/{index}', name: 'app_gift')]
    public function gift($index, SessionInterface $session, UserRepository $userRepository): Response
    {
        $user = $userRepository->find($this->getUser());
        $anotherArray = $session->get('giftcart', []);
        $anotherArray[$index]['gift'] = true;
        if ($anotherArray[$index]['friend'] == 'none'){
            $anotherArray[$index]['friend'] = $user->getFriends()->get(0)->getFriend();
        }
        $session->set('giftcart', $anotherArray);
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
        $user = $userRepository->find($this->getUser());
        foreach ($cart as $gameId){
            $game = $gamesRepository->find($gameId);
            $user->addGame($game);
        }

        $userRepository->save($user, true);
        }
        $session->remove('Cart');
        return $this->redirectToRoute('app_cart');
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
