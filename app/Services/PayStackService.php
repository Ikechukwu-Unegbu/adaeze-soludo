<?php

namespace App\Services;

use Exception;
use App\Services\OrderService;
use Illuminate\Support\Facades\DB;
use App\Models\PayStackTransaction;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PayStackService 
{
    public static function initializePayment()
    {
        try {

            return DB::transaction(function() {               

                $transaction = self::initializeTransaction();

                $response = Http::withHeaders([
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . config('paystack.secret_key'),
                ])->post('https://api.paystack.co/transaction/initialize', [
                    'reference'     =>  $transaction->reference_id,
                    'amount'        =>  intval($transaction->amount * 100),
                    'currency'      =>  $transaction->currency,
                    'email'         =>  $transaction->user->email,
                    'callback_url'  =>  route('checkout.verify-payment'),
                    'channels'      =>  ['card', 'bank', 'bank_transfer']
                ]);

                if ( ! $response->ok()) {
                    throw new Exception('Invalid Response From Payment Gateway');
                }

                $response = $response->object();

                return collect([
                    'paymentLink' => $response->data->authorization_url,
                    'message' => $response->message,
                    'status' => $response->status,
                    'reference' =>  $response->data->reference
                ]);
            });

        } catch (\Throwable $th) {
            // dd($th->getMessage());
            Log::error($th->getMessage());
        }
    }

    public static function verifyPayment($transactionId): bool
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . config('paystack.secret_key'),
        ])->get("https://api.paystack.co/transaction/verify/$transactionId");
        
        $response = $response->object();

        if (! isset($response->status) || ! isset($response->data->status)) return false;
        
        if ($response->status || $response->data->status == 'success') {

            $transaction = PayStackTransaction::where('reference_id', $transactionId)->first();

            if ($transaction == null || ! $transaction->exists()) {
                return false;
            }
            
            $transaction->successful();
            return true;
        }

        return false;
    }

    public static function initializeTransaction()
    {
        $order = OrderService::createOrder();
    
        return PayStackTransaction::create([
            'user_id'       => $order->user_id,
            'order_id'      => $order->id,
            'amount'        => $order->orderItems->sum('amount'),
            'currency'      => config('paystack.currency', 'NGN'),
            'meta'          => json_encode([
                'order_id'      => $order->id,
                'user_email'    => $order->user->email,
                'items'         => $order->orderItems->map(function ($item) {
                    return [
                        'id'       => $item->id,
                        'name'     => $item->product->name,
                        'quantity' => $item->quantity,
                        'amount'   => $item->amount,
                    ];
                }),
                'created_at'    => now()->toDateTimeString(),
            ]),
        ]);
    }
    
}