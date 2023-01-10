<?php

namespace App\Manager;

use App\Entity\Games;

class GameManager
{
    public function hasCategories(Games $game, array $categories): bool
    {
        $gameCategoryIds = [];
        foreach ($game->getCategories() as $category) {
            $gameCategoryIds[] = $category->getId();
        }

        $diff = array_diff($categories, $gameCategoryIds);

        return empty($diff);
    }
}