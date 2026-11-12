<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
class SSLCommerzController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Step 1: Start Payment
    |--------------------------------------------------------------------------
    */

    public function pay($orderId)
    {
        $order = Order::findOrFail($orderId);

        // Check payment method
        if ($order->payment_method !== 'sslcommerz') {
            abort(403, 'Invalid payment method.');
        }

        // Already paid?
        if ($order->payment_status === 'paid') {
            return redirect()->route('order.confirm', $order->id);
        }

        // Check credentials
        $storeId = config('services.sslcommerz.store_id');
        $storePassword = config('services.sslcommerz.store_password');

        if (!$storeId || !$storePassword) {
            return redirect()
                ->route('checkout')
                ->with('error', 'SSLCommerz credentials missing.');
        }

        // Generate unique transaction ID
        $transactionId = 'M' . Str::upper(Str::random(20));

        // Save transaction ID
        $order->update([
            'transaction_id' => $transactionId,
            'payment_status' => 'unpaid',
        ]);

        // Sandbox or Live URL
        $apiUrl = config('services.sslcommerz.sandbox')
            ? 'https://sandbox.sslcommerz.com/gwprocess/v4/api.php'
            : 'https://securepay.sslcommerz.com/gwprocess/v4/api.php';

        try {

            // Send payment request
            $response = Http::asForm()
                ->timeout(30)
                ->post($apiUrl, [

                    // Store information
                    'store_id' => $storeId,
                    'store_passwd' => $storePassword,

                    // Payment information
                    'total_amount' => number_format(
                        (float) $order->total,
                        2,
                        '.',
                        ''
                    ),

                    'currency' => 'BDT',
                    'tran_id' => $transactionId,

                    // Callback routes
                    'success_url' => route('sslcommerz.success'),
                    'fail_url' => route('sslcommerz.fail'),
                    'cancel_url' => route('sslcommerz.cancel'),

                    // Customer information
                    'cus_name' => $order->first_name . ' ' . $order->last_name,
                    'cus_email' => $order->email,
                    'cus_add1' => $order->address,
                    'cus_add2' => '',
                    'cus_city' => $order->city,
                    'cus_state' => $order->distirct,
                    'cus_postcode' => '1000',
                    'cus_country' => 'Bangladesh',
                    'cus_phone' => $order->phone,

                    // Shipping information
                    'shipping_method' => 'YES',
                    'ship_name' => $order->first_name . ' ' . $order->last_name,
                    'ship_add1' => $order->address,
                    'ship_add2' => '',
                    'ship_city' => $order->city,
                    'ship_state' => $order->distirct,
                    'ship_postcode' => '1000',
                    'ship_country' => 'Bangladesh',

                    // Product information
                    'num_of_item' => max(
                        1,
                        (int) $order->items()->sum('quantity')
                    ),

                    'product_name' => 'MONOTECH Products',
                    'product_category' => 'Computer Parts',
                    'product_profile' => 'physical-goods',

                ]);

            $data = $response->json();

            // Check gateway response
            if (
                $response->successful() &&
                isset($data['status']) &&
                $data['status'] === 'SUCCESS' &&
                !empty($data['GatewayPageURL'])
            ) {
                return redirect()->away($data['GatewayPageURL']);
            }

            Log::error('SSLCommerz initiation failed', [
                'order_id' => $order->id,
                'response' => $response->body(),
            ]);

            return redirect()
                ->route('checkout')
                ->with(
                    'error',
                    $data['failedreason'] ?? 'Payment initiation failed.'
                );

        } catch (\Throwable $e) {

            Log::error('SSLCommerz payment initiation exception', [
                'order_id' => $order->id,
                'message' => $e->getMessage(),
            ]);

            return redirect()
                ->route('checkout')
                ->with('error', 'Payment gateway connection failed.');
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Step 2: Validate Payment
    |--------------------------------------------------------------------------
    */

    private function validatePayment(Request $request)
    {
        $transactionId = $request->input('tran_id');
        $validationId = $request->input('val_id');

        if (!$transactionId || !$validationId) {

            Log::warning('SSLCommerz callback missing data', [
                'tran_id' => $transactionId,
                'val_id_present' => !empty($validationId),
            ]);

            return false;
        }

        $order = Order::where('transaction_id', $transactionId)
            ->where('payment_method', 'sslcommerz')
            ->first();

        if (!$order) {

            Log::warning('SSLCommerz order not found', [
                'tran_id' => $transactionId,
            ]);

            return false;
        }

        $storeId = config('services.sslcommerz.store_id');
        $storePassword = config('services.sslcommerz.store_password');

        if (!$storeId || !$storePassword) {
            Log::error('SSLCommerz validation credentials missing');
            return false;
        }

        // Sandbox or Live validation URL
        $validationUrl = config('services.sslcommerz.sandbox')
            ? 'https://sandbox.sslcommerz.com/validator/api/validationserverAPI.php'
            : 'https://securepay.sslcommerz.com/validator/api/validationserverAPI.php';

        try {

            // Verify directly with SSLCommerz
            $response = Http::timeout(30)->get($validationUrl, [

                'val_id' => $validationId,
                'store_id' => $storeId,
                'store_passwd' => $storePassword,
                'format' => 'json',

            ]);

            if (!$response->successful()) {

                Log::error('SSLCommerz validation HTTP failed', [
                    'order_id' => $order->id,
                    'http_status' => $response->status(),
                ]);

                return false;
            }

            $data = $response->json();

            if (!is_array($data)) {

                Log::error('SSLCommerz invalid validation response', [
                    'order_id' => $order->id,
                ]);

                return false;
            }

            // Accept VALID and VALIDATED status
            if (!in_array(
                $data['status'] ?? '',
                ['VALID', 'VALIDATED'],
                true
            )) {

                Log::warning('SSLCommerz transaction status invalid', [
                    'order_id' => $order->id,
                    'status' => $data['status'] ?? null,
                ]);

                return false;
            }

            // Check transaction ID
            if (($data['tran_id'] ?? '') !== $transactionId) {

                Log::warning('SSLCommerz transaction ID mismatch', [
                    'order_id' => $order->id,
                ]);

                return false;
            }

            // Check amount
            $gatewayAmount = (float) ($data['amount'] ?? 0);
            $orderAmount = (float) $order->total;

            if (abs($gatewayAmount - $orderAmount) > 0.01) {

                Log::warning('SSLCommerz amount mismatch', [
                    'order_id' => $order->id,
                    'gateway_amount' => $gatewayAmount,
                    'order_amount' => $orderAmount,
                ]);

                return false;
            }

            // Check currency
            if (strtoupper($data['currency'] ?? '') !== 'BDT') {

                Log::warning('SSLCommerz currency mismatch', [
                    'order_id' => $order->id,
                    'currency' => $data['currency'] ?? null,
                ]);

                return false;
            }

            // Update order atomically
            DB::transaction(function () use ($order, $validationId) {

                $lockedOrder = Order::lockForUpdate()
                    ->findOrFail($order->id);

                // Prevent duplicate payment processing
                if ($lockedOrder->payment_status !== 'paid') {

                    $lockedOrder->update([

                        'payment_status' => 'paid',
                        'order_status' => 'processing',
                        'val_id' => $validationId,

                    ]);
                }
            });

            return $order->fresh();

        } catch (\Throwable $e) {

            Log::error('SSLCommerz payment verification exception', [
                'order_id' => $order->id,
                'message' => $e->getMessage(),
            ]);

            return false;
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Step 3: Payment Success
    |--------------------------------------------------------------------------
    */

    public function success(Request $request)
    {
        $order = $this->validatePayment($request);

        if (!$order) {

            return redirect()
                ->route('checkout')
                ->with('error', 'Payment verification failed.');
        }

        // Clear cart only after verified payment
      

        return redirect()
            ->route('order.confirm', $order->id)
            ->with('success', 'Payment completed successfully!');
    }


    /*
    |--------------------------------------------------------------------------
    | Step 4: Payment Failed
    |--------------------------------------------------------------------------
    */

    public function fail(Request $request)
    {
        $order = Order::where(
            'transaction_id',
            $request->input('tran_id')
        )->first();

        if ($order && $order->payment_status !== 'paid') {

            $order->update([
                'payment_status' => 'failed',
            ]);
        }

        return redirect()
            ->route('checkout')
            ->with('error', 'Payment failed. Please try again.');
    }


    /*
    |--------------------------------------------------------------------------
    | Step 5: Payment Cancel
    |--------------------------------------------------------------------------
    */

    public function cancel(Request $request)
    {
        $order = Order::where(
            'transaction_id',
            $request->input('tran_id')
        )->first();

        if ($order && $order->payment_status !== 'paid') {

            $order->update([
                'payment_status' => 'cancelled',
            ]);
        }

        return redirect()
            ->route('checkout')
            ->with('error', 'Payment cancelled.');
    }


    /*
    |--------------------------------------------------------------------------
    | Step 6: IPN Notification
    |--------------------------------------------------------------------------
    */

    public function ipn(Request $request)
    {
        $order = $this->validatePayment($request);

        if (!$order) {
            return response('Payment validation failed', 400);
        }

        return response('OK', 200);
    }
}
