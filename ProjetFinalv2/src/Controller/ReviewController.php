<?php

namespace App\Controller;

use App\Entity\Review;
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
        ]);
    }
}
