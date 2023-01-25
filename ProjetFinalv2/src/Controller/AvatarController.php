<?php

namespace App\Controller;

use App\Entity\Avatar;
use App\Manager\AvatarManager;
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
    private AvatarManager $avatarManager;

    public function __construct(AvatarManager $avatarManager)
    {
        $this->avatarManager = $avatarManager;
    }
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

        $cloth = $request->get('cloth');
        $eyes = $request->get('eyes');
        $head = $request->get('head');
        $hair = $request->get('hair');
        $mouth = $request->get('mouth');
        $nose = $request->get('nose');
        $clothStyle = $request->get('clothStyle');
        $eyeColor = $request->get('eyeColor');
        $skin = $request->get('skin');
        $hairColor = $request->get('hairColor');

        $cloth = $this->avatarManager->checkPartValue($cloth, $avatarPartRepository,21);
        $eyes = $this->avatarManager->checkPartValue($eyes, $avatarPartRepository,9);
        $head = $this->avatarManager->checkPartValue($head, $avatarPartRepository,1);
        $hair = $this->avatarManager->checkPartValue($hair, $avatarPartRepository,5);
        $mouth = $this->avatarManager->checkPartValue($mouth, $avatarPartRepository,17);
        $nose = $this->avatarManager->checkPartValue($nose, $avatarPartRepository,13);
        $clothStyle = $this->avatarManager->checkColorValue($clothStyle, $avatarColorRepository, 1);
        $eyeColor = $this->avatarManager->checkColorValue($eyeColor, $avatarColorRepository, 1);
        $skin = $this->avatarManager->checkColorValue($skin, $avatarColorRepository, 1);
        $hairColor = $this->avatarManager->checkColorValue($hairColor, $avatarColorRepository, 1);

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