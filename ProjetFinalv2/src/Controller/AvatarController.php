<?php

namespace App\Controller;

use App\Repository\AvatarColorRepository;
use App\Repository\AvatarPartRepository;
use App\Repository\AvatarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AvatarController extends AbstractController
{
    #[Route('/avatar', name: 'app_avatar')]
    public function index(AvatarPartRepository $avatarPartRepository, AvatarColorRepository $avatarColorRepository): Response
    {
        return $this->render('profil/avatar.html.twig',[
            'heads' => $avatarPartRepository->findLike('head'),
            'hairs' => $avatarPartRepository->findLike('hair'),
            'eyes' => $avatarPartRepository->findLike('eyes'),
            'mouths' => $avatarPartRepository->findLike('mouth'),
            'noses' => $avatarPartRepository->findLike('nose'),
            'cloths' => $avatarPartRepository->findLike('cloth'),
            'colors' => $avatarColorRepository->findAll()
        ]);
    }

}