<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Stripe\Stripe;
use Stripe\Webhook;
use Stripe\PaymentIntent;

class StripeWebhookController extends AbstractController
{
    public function handleWebhook(Request $request)
    {
        // Set the Stripe API key
        Stripe::setApiKey('YOUR_STRIPE_SECRET_KEY');

        // Retrieve the event data from the request body
        $event = json_decode($request->getContent());

        // Verify the event signature
        $webhookSecret = 'YOUR_WEBHOOK_SECRET';
        $event = Webhook::constructEvent($request->getContent(), $request->headers->get('stripe-signature'), $webhookSecret);

        // Handle the event based on its type
        switch ($event->type) {
            case 'payment_intent.succeeded':
                // Payment succeeded
                $paymentIntentId = $event->data->object->id;
                $this->handlePaymentSucceeded($paymentIntentId);
                break;
            case 'payment_intent.payment_failed':
                // Payment failed
                $paymentIntentId = $event->data->object->id;
                $this->handlePaymentFailed($paymentIntentId);
                break;
            default:
                // Unknown event type
                break;
        }

        // Return a 200 OK response to acknowledge receipt of the webhook
        return new Response();
    }

    private function handlePaymentSucceeded(string $paymentIntentId)
    {
        // Retrieve the payment intent
        $paymentIntent = PaymentIntent::retrieve($paymentIntentId);

        // Update your database or perform other actions based on the payment status
    }

    private function handlePaymentFailed(string $paymentIntentId)
    {
        // Retrieve the payment intent
        $paymentIntent = PaymentIntent::retrieve($paymentIntentId);

        // Update your database or perform other actions based on the payment status
    }
}


