<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Review;
use App\Form\CommentFormType;
use App\Form\ReviewFormType;
use App\Repository\GamesRepository;
use App\Repository\ReviewRepository;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReviewController extends AbstractController
{
    #[Route('/review/{id}', name: 'app_review')]
    public function index($id,GamesRepository $gamesRepository, Request $request, ManagerRegistry $doctrine, ReviewRepository $reviewRepository): Response
    {
        $game = $gamesRepository->find($id);
        $userGames = $this->getUser()->getGame()->getValues();
        if(in_array($game, $userGames)){
            $allow = true;
        }
        else{
            $allow = false;
        }

        $review = new Review();
        $form = $this->createForm(ReviewFormType::class, $review);
        $form->handleRequest($request);
        if($form->isSubmitted() and $form->isValid()){
            $review->setGame($gamesRepository->find($id));
            $review->setUser($this->getUser());
            $em = $doctrine->getManager();
            $em->persist($review);
            $em->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('review/index.html.twig', [
            'game' => $gamesRepository->find($id),
            'review' => $form->createView(),
            'allow' => $allow,
        ]);
    }
    #[Route('/review/page/{id}', name: 'app-review-page')]
    public function reviewPage($id, ReviewRepository $reviewRepository, Request $request, ManagerRegistry $doctrine)
    {
        $comment = new Comment();
        $review = $reviewRepository->find($id);
        $form = $this->createForm(CommentFormType::class, $comment);
        $form->handleRequest($request);
        if($form->isSubmitted() and  $form->isValid()){
            $comment->setUser($this->getUser());
            $comment->setReview($review);
            $em = $doctrine->getManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirectToRoute('app-review-page', ['id' => $id]);
        }
        return $this->render('review/review-page.html.twig', [
            'review' => $review,
            'comment' => $form->createView(),
        ]);
    }
}
