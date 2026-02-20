<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Enums\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Notification;

class PaymentCallbackController extends Controller
{
    public function handle(Request $request)
    {
        try {
            Log::info('Callback Input: ' . file_get_contents('php://input'));
            Log::info('Callback Request Data: ' . json_encode($request->all()));

            // Set configuration
            Config::$serverKey = config('services.midtrans.server_key');
            Config::$isProduction = config('services.midtrans.is_production');
            Config::$isSanitized = true;
            Config::$is3ds = true;

            // Fix for local SSL issues
            if (config('app.env') === 'local') {
                Config::$curlOptions = [
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_SSL_VERIFYHOST => 0,
                    CURLOPT_HTTPHEADER => [],
                ];
            }

            // Create instance of notification
            if (config('app.env') === 'local') {
                $notification = (object) [
                    'transaction_status' => $request->input('transaction_status'),
                    'payment_type' => $request->input('payment_type'),
                    'order_id' => $request->input('order_id'),
                    'fraud_status' => $request->input('fraud_status'),
                ];
            } else {
                $notification = new Notification();
            }

            $transactionStatus = $notification->transaction_status;
            $type = $notification->payment_type;
            $orderId = $notification->order_id;
            $fraud = $notification->fraud_status;

            // Find order by order_number (which is passed as order_id to Midtrans)
            $order = Order::where('order_number', $orderId)->firstOrFail();

            if ($transactionStatus == 'capture') {
                if ($type == 'credit_card') {
                    if ($fraud == 'challenge') {
                        $order->update([
                            'status' => OrderStatus::Pending,
                            'payment_status' => 'challenge'
                        ]);
                    } else {
                        $order->update([
                            'status' => OrderStatus::Processing,
                            'payment_status' => 'paid'
                        ]);
                        $this->sendOrderPaidEmail($order);
                    }
                }
            } else if ($transactionStatus == 'settlement') {
                $order->update([
                    'status' => OrderStatus::Processing,
                    'payment_status' => 'paid'
                ]);
                $this->sendOrderPaidEmail($order);
            } else if ($transactionStatus == 'pending') {
                $order->update([
                    'status' => OrderStatus::Pending,
                    'payment_status' => 'pending'
                ]);
            } else if ($transactionStatus == 'deny') {
                $order->update([
                    'status' => OrderStatus::Cancelled,
                    'payment_status' => 'denied'
                ]);
            } else if ($transactionStatus == 'expire') {
                $order->update([
                    'status' => OrderStatus::Cancelled,
                    'payment_status' => 'expired'
                ]);
            } else if ($transactionStatus == 'cancel') {
                $order->update([
                    'status' => OrderStatus::Cancelled,
                    'payment_status' => 'cancelled'
                ]);
            }

            Log::info("Payment notification received for order: $orderId, status: $transactionStatus");

            return response()->json(['message' => 'Payment notification received']);

        } catch (\Exception $e) {
            Log::error('Payment Callback Error', ['exception' => $e]);
            return response()->json(['message' => 'Error handling notification'], 500);
        }
    }

    private function sendOrderPaidEmail(Order $order)
    {
        try {
            \Illuminate\Support\Facades\Mail::to($order->customer_email)->send(new \App\Mail\OrderPaidMail($order));
        } catch (\Exception $e) {
            Log::error('Failed to send OrderPaidMail from webhook: ' . $e->getMessage());
        }
    }
}
