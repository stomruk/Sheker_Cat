<?php

namespace App\Controller;

use Stripe\Checkout\Session;
use Stripe\PaymentIntent;
use Stripe\Event;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Stripe;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class StripeController extends AbstractController
{
    #[Route('/stripe', name: 'app_stripe')]
    public function index(): Response
    {
        return $this->render('stripe/index.html.twig', [
            'stripe_key' => $_ENV['STRIPE_KEY'],
        ]);
    }
    #[Route('/checkout', name: 'checkout', methods: ['POST'])]
    public function createCharge(SessionInterface $oturum): Response
    {
        Stripe\Stripe::setApiKey($_ENV['STRIPE_SECRET']);

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items'           => [
                [
                    'price_data' => [
                        'currency'     => 'eur',
                        'product_data' => [
                            'name' => 'Art',
                        ],
                        'unit_amount'  => 9000 * 100,
                    ],
                    'quantity'   => 1,
                ]
            ],
            'mode'                 => 'payment',
            'success_url'          => $this->generateUrl('app_home', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'cancel_url'           => $this->generateUrl('app_home', [], UrlGeneratorInterface::ABSOLUTE_URL),
        ]);
        $pay = PaymentIntent::retrieve($session->payment_intent);
        $oturum->set('stat', $pay);

        return $this->redirect($session->url, 303);
    }

    #[Route('/webhook', name: 'webhook', methods: ['POST'])]
    public function webhook(SessionInterface $session): Response
    {
        $session->set('stat', 'test7');
        $payload = @file_get_contents('php://input');
        $event = null;

        try {
            $event = \Stripe\Event::constructFrom(
                json_decode($payload, true)
            );
            dump($event);
        } catch(\UnexpectedValueException $e) {
            // Invalid payload
            http_response_code(400);
            exit();
        }
        dump($event);
// Handle the event
        switch ($event->type) {
            case 'payment_intent.succeeded':
//                $paymentIntent = $event->data->object; // contains a \Stripe\PaymentIntent
                $session->set('stat', 'test5');
                break;
            case 'payment_method.attached':
                $paymentMethod = $event->data->object; // contains a \Stripe\PaymentMethod
                // Then define and call a method to handle the successful attachment of a PaymentMethod.
                // handlePaymentMethodAttached($paymentMethod);
                break;
            // ... handle other event types
            default:
                echo 'Received unknown event type ' . $event->type;
        }
        dump($event);

        return $this->redirectToRoute('app_home');
    }

}
