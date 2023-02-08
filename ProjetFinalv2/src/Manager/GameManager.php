<?php

namespace App\Manager;

use App\Entity\Games;
use App\Entity\Notification;
use App\Repository\GamesRepository;
use App\Repository\NotificationRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class GameManager extends AbstractController
{
    private SessionInterface $session;
    public function hasCategories(Games $game, array $categories): bool
    {
        $gameCategoryIds = [];
        foreach ($game->getCategories() as $category) {
            $gameCategoryIds[] = $category->getId();
        }

        $diff = array_diff($categories, $gameCategoryIds);

        return empty($diff);
    }

    public function paymentSuccess(SessionInterface $session){
        $this->session->set('stat', 'tetetete');
        $path = __DIR__.'test.txt';
        file_put_contents($path, "success \n",FILE_APPEND);
    }
    public function handleCart(SessionInterface $session, UserRepository $userRepository, NotificationRepository $notificationRepository, GamesRepository $gamesRepository){
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
            else{
                $game = $gamesRepository->find($item['game']);
                $user = $userRepository->find($this->getUser());
                $user->addGame($game);
            }
        }
        $session->remove('Cart');
    }
}