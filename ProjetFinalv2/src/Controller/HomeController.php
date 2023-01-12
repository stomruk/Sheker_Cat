<?php

namespace App\Controller;

use App\Entity\Games;
use App\Entity\User;
use App\Repository\GamesRepository;
use App\Repository\NotificationRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
        return $this->render('home/cart.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/addcart/{id}', name: 'app_add_cart')]
    public function addcart($id,GamesRepository $gamesRepository,SessionInterface $session): Response
    {
        $cart = $session->get('Cart', []);
        $product = $gamesRepository->find($id);
        $cart[] = $product;
        $session->set('Cart', $cart);
        return $this->redirectToRoute('app_cart');
    }

    #[Route('/clearcart', name: 'app_clear_cart')]
    public function clear(SessionInterface $session): Response
    {
        $session->remove('Cart');
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
    public function buygame(SessionInterface $session, UserRepository $userRepository, GamesRepository $gamesRepository): Response
    {
        $cart = $session->get('Cart');
        $user = $userRepository->find($this->getUser());
        foreach ($cart as $gameId){
            $game = $gamesRepository->find($gameId);
            $user->addGame($game);
        }

        $userRepository->save($user, true);
        $session->remove('Cart');
        return $this->redirectToRoute('app_cart');
    }

    #[Route('/notification', name: 'app_notification')]
    public function notification(NotificationRepository $notificationRepository): Response
    {
        return $this->redirectToRoute('app_cart');
    }

}
