<?php

namespace App\Controller;

use App\Entity\Avatar;
use App\Repository\AvatarColorRepository;
use App\Repository\AvatarPartRepository;
use App\Repository\AvatarRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    #[Route('/create/avatar', name: 'app_create_avatar')]
    public function createAvatar(Request $request, AvatarPartRepository $avatarPartRepository, AvatarColorRepository $avatarColorRepository, AvatarRepository $avatarRepository, UserRepository $userRepository): Response
    {
        $user = $this->getUser();
        $user = $userRepository->find($user);
        $avatar = new Avatar();
        $cloth = $avatarPartRepository->find($request->get('cloth'));
        $clothStyle = $avatarColorRepository->find($request->get('clothStyle'));
        $eyes = $avatarPartRepository->find($request->get('eyes'));
        $eyeColor = $avatarColorRepository->find($request->get('eyeColor'));
        $head = $avatarPartRepository->find($request->get('head'));
        $skin = $avatarColorRepository->find($request->get('skin'));
        $hair = $avatarPartRepository->find($request->get('hair'));
        $hairColor = $avatarColorRepository->find($request->get('hairColor'));
        $mouth = $avatarPartRepository->find($request->get('mouth'));
        $nose = $avatarPartRepository->find($request->get('nose'));

        $avatar->setCloth($cloth);
        $avatar->setClothStyle($clothStyle);
        $avatar->setEyes($eyes);
        $avatar->setEyeColor($eyeColor);
        $avatar->setHead($head);
        $avatar->setSkin($skin);
        $avatar->setHair($hair);
        $avatar->setHairColor($hairColor);
        $avatar->setMouth($mouth);
        $avatar->setNose($nose);

        $user->setAvatar($avatar);
        $userRepository->save($user, true);
        $avatarRepository->save($avatar, true);
        return $this->render('home/index.html.twig');
    }

}