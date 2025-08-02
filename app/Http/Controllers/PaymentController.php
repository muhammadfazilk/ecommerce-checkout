<?php

namespace App\Http\Controllers;

use App\Http\Requests\PayNowRequest;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function checkoutPage()
    {
        $product = Product::inRandomOrder()->first();

        return view('payment.checkout', compact('product'));
    }

    public function payNow(PayNowRequest $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $charge = \Stripe\Charge::create([
                'amount' => $request->amount * 100,
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => 'Payment for '.$request->product_name,
                'receipt_email' => $request->customer_email,
            ]);

            $payment = Payment::create([
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'amount' => $request->amount,
                'payment_gateway' => 'Stripe',
                'transaction_id' => $charge->id,
                'status' => $charge->status,
            ]);

            Mail::raw("Thank you for your payment of \${$request->amount}", function ($message) use ($request) {
                $message->to($request->customer_email)->subject('Payment Successful');
            });

            return redirect()->route('success', ['id' => $payment->id]);
        } catch (\Exception $e) {
            info('Payment failed: '.$e->getMessage());

            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function success($id)
    {
        $payment = Payment::findOrFail($id);

        return view('payment.success', compact('payment'));
    }
}
