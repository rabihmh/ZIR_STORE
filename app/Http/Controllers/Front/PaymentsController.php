<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function create(Order $order)
    {
        return view('front.payments.create', ['order' => $order]);
    }

    public function createStripePaymentIntent(Order $order)
    {
        $amount = $order->items->sum(function($item) {
            return $item->price * $item->quantity;
        });
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret_key'));
        $paymentIntent = $stripe->paymentIntents->create([
            'amount' => $amount,
            'currency' => 'usd',
            'payment_method_types' => ['card'],
        ]);
        return [
            'clientSecret' => $paymentIntent->client_secret,

        ];
    }

    public function confirm(Request $request, Order $order)
    {
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret_key'));
        $paymentIntent = $stripe->paymentIntents->retrieve(
            $request->query('payment_intent'),
            []
        );
        try {
            if ($paymentIntent->status == 'succeeded') {
                $payment = new Payment();
                $payment->forceFill([
                    'order_id' => $order->id,
                    'amount' => $paymentIntent->amount,
                    'currency' => $paymentIntent->currency,
                    'status' => 'completed',
                    'method' => 'stripe',
                    'transaction_id' => $paymentIntent->id,
                    'transaction_data' => json_encode($paymentIntent)
                ])->save();
            }
        } catch (QueryException $e) {
            echo $e->getMessage();
            return;
        }
        // event('payment.crated',$payment->id);
        return redirect()->route('home', [
            'status' => 'payment succeeded'
        ]);
    }
}
