<?php

namespace App\Manager;

use App\Repository\AvatarColorRepository;
use App\Repository\AvatarPartRepository;

class AvatarManager
{
    public function checkPartValue($value, AvatarPartRepository $avatarPartRepository, $default): \App\Entity\AvatarPart
    {
        if($value == null){
            $part = $avatarPartRepository->find($default);
        }
        else{
            $part = $avatarPartRepository->find($value);
        }
        return $part;
    }


    public function checkColorValue($value, AvatarColorRepository $avatarColorRepository, $default): \App\Entity\AvatarColor
    {
        if($value == null){
            $color = $avatarColorRepository->find($default);
        }
        else{
            $color = $avatarColorRepository->find($value);
        }
        return $color;
    }
}