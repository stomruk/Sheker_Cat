<?php

namespace App\Controller;

use App\Repository\HairColorRepository;
use App\Repository\HairRepository;
use App\Repository\HeadRepository;
use App\Repository\SkinColorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AvatarController extends AbstractController
{
    #[Route('/avatar', name: 'app_avatar')]
    public function index(HeadRepository $headRepository, SkinColorRepository $skinColorRepository, HairRepository $hairRepository,HairColorRepository $hairColorRepository): Response
    {
        return $this->render('profil/avatar.html.twig',
            [
            'heads' => $headRepository->findAll(),
            'skins' => $skinColorRepository->findAll(),
            'hairs' => $hairRepository->findAll(),
            'hairColors' => $hairColorRepository->findAll(),
            ]);
    }

}