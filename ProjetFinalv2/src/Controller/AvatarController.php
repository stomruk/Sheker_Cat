<?php

namespace App\Controller;

use App\Repository\EyesRepository;
use App\Repository\HairColorRepository;
use App\Repository\HairRepository;
use App\Repository\HeadRepository;
use App\Repository\MouthRepository;
use App\Repository\SkinColorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AvatarController extends AbstractController
{
    #[Route('/avatar', name: 'app_avatar')]
    public function index(HeadRepository $headRepository, SkinColorRepository $skinColorRepository, HairRepository $hairRepository,HairColorRepository $hairColorRepository,EyesRepository $eyesRepository, MouthRepository $mouthRepository): Response
    {
        return $this->render('profil/avatar.html.twig',
            [
            'heads' => $headRepository->findAll(),
            'skins' => $skinColorRepository->findAll(),
            'hairs' => $hairRepository->findAll(),
            'hairColors' => $hairColorRepository->findAll(),
            'eyes' => $eyesRepository->findAll(),
            'mouths' => $mouthRepository->findAll(),
            ]);
    }

}