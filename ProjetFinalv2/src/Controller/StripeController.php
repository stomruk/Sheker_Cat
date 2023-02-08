<?php

namespace App\Controller;

use App\Entity\Notification;
use App\Repository\GamesRepository;
use App\Repository\NotificationRepository;
use App\Repository\UserRepository;
use Stripe\Checkout\Session;
use Stripe\PaymentIntent;
use Stripe\Event;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Stripe;
use App\Manager\GameManager;
class StripeController extends AbstractController
{

    #[Route('/stripe', name: 'app_stripe')]
    public function index(SessionInterface $session): Response
    {
        return $this->render('stripe/index.html.twig', [
            'stripe_key' => $_ENV['STRIPE_KEY'],
        ]);
    }
    #[Route('/checkout', name: 'checkout', methods: ['POST'])]
    public function createCharge(SessionInterface $oturum, UserRepository $userRepository): Response
    {
        $cart = [];
        $stripeCart = [];
        foreach ($oturum->get('Cart') as $item){
            $cart[] = $item;
        }
        foreach ($cart as $item){
            if ($item['gift'] == false){
                $user = $this->getUser()->getId();
            }
            else{
                $user = $item['friend']['id'];
            }
            $stripeCart[] = [
                'price_data' => [
                    'currency'     => 'eur',
                    'product_data' => [
                        'name' => $item['game']->getName(),
                        'metadata' => ['gift' => $item['gift'],'gameOwner' => $user, 'game' => $item['game']->getId(), 'user' => $this->getUser()->getId()]
                    ],
                    'unit_amount'  => $item['game']->getPrice() * 100,
                ],
                'quantity'   => 1,
            ];
        }
        Stripe\Stripe::setApiKey($_ENV['STRIPE_SECRET']);

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items'           => [$stripeCart],
            'mode'                 => 'payment',
            'success_url'          => 'http://localhost:8000/games',
            'cancel_url'           => 'http://localhost:8000/profil/1',
        ]);

        return $this->redirect($session->url, 303);
    }
    #[Route('/succes', name: 'succes')]
    public function succes(): Response
    {
        return $this->redirectToRoute('app_game_list');
    }

//    #[Route('/stripe_webhook', name: 'webhook', methods: ['POST'])]
    public function webhook(GamesRepository $gamesRepository, UserRepository $userRepository, NotificationRepository $notificationRepository)
    {
// Set your secret key. Remember to switch to your live secret key in production.
// See your keys here: https://dashboard.stripe.com/apikeys
        Stripe\Stripe::setApiKey('sk_test_XtZYTYhe9JXmnbe9e8sI1ILu');
        $stripe = new Stripe\StripeClient("sk_test_XtZYTYhe9JXmnbe9e8sI1ILu");
        $endpoint_secret = 'whsec_0d1cbd40b98be223260c760d3ece7838ca055d081f72bb3c0dc36933868897cf';
        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;
        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            http_response_code(400);
            exit();
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            http_response_code(400);
            exit();
        }
        $path = __DIR__ . 'test.txt';

// Handle the event
        $event->type;
        switch ($event->data->object->object) {
            case 'checkout.session':
                if ($event->data->object->payment_status == 'paid'){
                    $sessionID = $event->data->object->id;
                    $line_items = $stripe->checkout->sessions->allLineItems($sessionID)->data;
                    foreach ($line_items as $item) {
                        $itemID = $item->price->product;
                        $product = $stripe->products->retrieve($itemID)->metadata;
                        $game = $gamesRepository->find($product->game);
                        $user = $userRepository->find($product->gameOwner);
                        if ($product->gift == 'true'){
                            $notification = new Notification();
                            $notification->setGame($game);
                            $friend = $userRepository->find($product->user);
                            $notification->setFriend($friend);
                            $notification->setUser($user);
                            $notification->setMessage('You received a gift');
                            $notificationRepository->save($notification, true);
                        }
                        else{
                            $user->addGame($game);
                            $userRepository->save($user, true);
                        }
                        file_put_contents($path, $game->getName().$user->getUsername()." \n", FILE_APPEND);
                    }
                }
        }
        http_response_code(200);
        exit();
    }
}