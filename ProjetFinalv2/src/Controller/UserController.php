<?php

namespace App\Controller;

use App\Repository\AvatarPartRepository;
use App\Repository\AvatarRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/profil/{username}', name: 'app_profil')]
    public function profil($username, UserRepository $userRepository, AvatarRepository $avatarRepository, AvatarPartRepository $avatarPartRepository): Response
    {
        $user = $userRepository->findBy(['username' => $username]);

        return $this->render('profil/profil.html.twig', ['user' => $user]);
    }
}
