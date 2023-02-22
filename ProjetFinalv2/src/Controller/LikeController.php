<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Like;
use App\Repository\AvatarPartRepository;
use App\Repository\AvatarRepository;
use App\Repository\CommentRepository;
use App\Repository\LikeRepository;
use App\Repository\ReviewRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LikeController extends AbstractController
{
    #[Route('/like/review/{id}', name: 'app_like_review')]
    public function likeReview($id, ReviewRepository $reviewRepository, LikeRepository $likeRepository): Response
    {
        $review = $reviewRepository->find($id);

        $like = new Like();
        $like->setUser($this->getUser());
        $like->setReview($review);

        $likeRepository->save($like, true);

        return $this->redirectToRoute('app-review-page',['id' => $review->getId()]);
    }

    #[Route('/unlike/review/{id}', name: 'app_unlike_review')]
    public function unlikeReview($id, LikeRepository $likeRepository): Response
    {
        $like = $likeRepository->find($id);
        $review = $like->getReview();

        $likeRepository->remove($like, true);

        return $this->redirectToRoute('app-review-page',['id' => $review->getId()]);
    }

    #[Route('/like/gamePage/review/{id}', name: 'app_like_gamepage_review')]
    public function likeGamePageReview($id, ReviewRepository $reviewRepository, LikeRepository $likeRepository): Response
    {
        $review = $reviewRepository->find($id);

        $game = $review->getGame();

        $like = new Like();
        $like->setUser($this->getUser());
        $like->setReview($review);

        $likeRepository->save($like, true);

        return $this->redirectToRoute('app_game_page',['id' => $game->getId()]);
    }

    #[Route('/unlike/gamePage/review/{id}', name: 'app_unlike_gamepage_review')]
    public function unlikeGamePageReview($id, LikeRepository $likeRepository): Response
    {
        $like = $likeRepository->find($id);
        $review = $like->getReview();
        $game = $review->getGame();

        $likeRepository->remove($like, true);

        return $this->redirectToRoute('app_game_page',['id' => $game->getId()]);
    }

    #[Route('/like/comment/{id}', name: 'app_like_comment')]
    public function likeComment($id, CommentRepository $commentRepository, LikeRepository $likeRepository): Response
    {
        $comment = $commentRepository->find($id);

        $like = new Like();
        $like->setUser($this->getUser());
        $like->setComment($comment);

        $likeRepository->save($like, true);

        return $this->redirectToRoute('app-review-page',['id' => $comment->getReview()->getId()]);
    }

    #[Route('/unlike/comment/{id}', name: 'app_unlike_comment')]
    public function unlikeComment($id, LikeRepository $likeRepository): Response
    {
        $like = $likeRepository->find($id);
        $comment = $like->getComment();


        $likeRepository->remove($like, true);

        return $this->redirectToRoute('app-review-page',['id' => $comment->getReview()->getId()]);
    }
}
