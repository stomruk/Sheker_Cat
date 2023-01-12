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

    #[Route('//notification', name: 'app_notification')]
    public function notification(): Response
    {

        return $this->render('notification/index.html.twig', [
            'controller_name' => 'NotificationController',
        ]);
    }

    #[Route('//notification/accept/{id}/{not}', name: 'app_accept_friend')]
    public function accept($id, $not, UserRepository $userRepository, NotificationRepository $notificationRepository, FriendsRepository $friendsRepository): Response
    {
        $friend = $userRepository->find($id);
        $newfriend = new Friends();
        $newfriend->setFriend($friend);
        $newfriend->setUser($this->getUser());
        $friendsRepository->save($newfriend, true);

        $newfriend1 = new Friends();
        $newfriend1->setFriend($this->getUser());
        $newfriend1->setUser($friend);
        $friendsRepository->save($newfriend1, true);

        $notif = $notificationRepository->find($not);
        $notificationRepository->remove($notif, true);

        return $this->render('notification/index.html.twig', [
            'controller_name' => 'NotificationController',
        ]);
    }
}
