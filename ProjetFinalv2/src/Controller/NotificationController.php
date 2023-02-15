<?php

namespace App\Controller;

use App\Entity\Friends;
use App\Entity\Notification;
use App\Repository\FriendsRepository;
use App\Repository\NotificationRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NotificationController extends AbstractController
{
    #[Route('/addfriend/{id}', name: 'app_add-friend')]
    public function index($id,UserRepository $userRepository, NotificationRepository $notificationRepository): Response
    {
        $notification = new Notification();
        $friend = $userRepository->find($id);
        $notification->setUser($friend);
        $notification->setFriend($this->getUser());
        $notification->setMessage('You have a friend request.');

        $notificationRepository->save($notification, true);
        return $this->redirectToRoute('app_profil',['id' => $id]);
    }

    #[Route('/notification', name: 'app_notification')]
    public function notification(): Response
    {

        return $this->render('notification/index.html.twig', [
            'controller_name' => 'NotificationController',
        ]);
    }

    #[Route('/notification/accept/friend/{id}', name: 'app_accept_friend')]
    public function acceptFriend($id, UserRepository $userRepository, NotificationRepository $notificationRepository, FriendsRepository $friendsRepository): Response
    {
        $notification = $notificationRepository->find($id);
        $friend = $notification->getFriend();
        $newFriend = new Friends();
        $newFriend->setUser($this->getUser());
        $newFriend->setFriend($friend);

        $friendsRepository->save($newFriend, true);

        $newFriend2 = new Friends();
        $newFriend2->setUser($friend);
        $newFriend2->setFriend($this->getUser());

        $friendsRepository->save($newFriend2, true);

        $notificationRepository->remove($notification, true);

        return $this->render('notification/index.html.twig', [
            'controller_name' => 'NotificationController',
        ]);
    }
    #[Route('/notification/refuse/{id}', name: 'app_refuse')]
    public function refuseFriend($id,NotificationRepository $notificationRepository): Response
    {
        $notification = $notificationRepository->find($id);
        $notificationRepository->remove($notification, true);

        return $this->render('notification/index.html.twig', [
            'controller_name' => 'NotificationController',
        ]);
    }

    #[Route('/notification/accept/gift/{id}', name: 'app_accept_gift')]
    public function acceptGift($id, NotificationRepository $notificationRepository, UserRepository $userRepository):Response
    {
        $notification = $notificationRepository->find($id);

        $game = $notification->getGame();
        $user = $notification->getUser();

        $user->addGame($game);
        $userRepository->save($user, true);

        $notificationRepository->remove($notification, true);


        return $this->render('notification/index.html.twig', [
            'controller_name' => 'NotificationController',
        ]);
    }
}
