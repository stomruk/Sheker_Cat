<?php

namespace App\Controller;

use App\Repository\AvatarPartRepository;
use App\Repository\AvatarRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/profil/{id}', name: 'app_profil')]
    public function profil($id, UserRepository $userRepository, AvatarRepository $avatarRepository, AvatarPartRepository $avatarPartRepository): Response
    {
        $user = $userRepository->find($id);

        return $this->render('profil/profil.html.twig', ['user' => $user]);
    }
    #[Route('/desc', name: 'app_desc')]
    public function desc(UserRepository $userRepository, Request $request): Response
    {
        $user = $userRepository->find($this->getUser());;
        $content = $request->get('content');
        $user->setDescription($content);
        $userRepository->save($user, true);
        return $this->redirectToRoute('app_profil',['id' => $user->getId()]);
    }
}
