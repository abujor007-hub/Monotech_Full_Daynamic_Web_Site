<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmedMail;
use App\Mail\OrderDeliveredMail;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Products;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        /*
    |--------------------------------------------------------------------------
    | Validate Checkout Form
    |--------------------------------------------------------------------------
    */

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'address' => 'required|string',
            'message' => 'nullable|string',

            'city' => 'required|string|max:255',
            'distirct' => 'required|string|max:255',

            'payment_method' => 'required|in:cod,bkash,sslcommerz',
        ]);

        /*
    |--------------------------------------------------------------------------
    | Get Cart
    |--------------------------------------------------------------------------
    */

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return back()
                ->withInput()
                ->with('error', 'Cart is empty');
        }

        /*
    |--------------------------------------------------------------------------
    | Calculate Subtotal
    |--------------------------------------------------------------------------
    */

        $subtotal = 0;

        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        /*
    |--------------------------------------------------------------------------
    | Shipping Charge
    |--------------------------------------------------------------------------
    */

        if (strtolower(trim($validated['distirct'])) === 'dhaka') {
            $shipping = 80;
        } else {
            $shipping = 150;
        }

        /*
    |--------------------------------------------------------------------------
    | Calculate Total
    |--------------------------------------------------------------------------
    */

        $total = $subtotal + $shipping;

        /*
    |--------------------------------------------------------------------------
    | Create Order + Order Items + Update Stock
    |--------------------------------------------------------------------------
    */

        try {

            $order = DB::transaction(function () use (
                $validated,
                $cart,
                $subtotal,
                $shipping,
                $total
            ) {

                /*
            |--------------------------------------------------------------------------
            | Create Order
            |--------------------------------------------------------------------------
            */

                $order = Order::create([

                    'user_id' => auth()->id(),

                    'first_name' => $validated['first_name'],
                    'last_name' => $validated['last_name'],

                    'phone' => $validated['phone'],
                    'email' => $validated['email'],

                    'address' => $validated['address'],
                    'message' => $validated['message'] ?? null,

                    'subtotal' => $subtotal,
                    'shipping' => $shipping,
                    'total' => $total,

                    'order_status' => 'pending',

                    'payment_method' => $validated['payment_method'],

                    'city' => $validated['city'],
                    'distirct' => $validated['distirct'],

                ]);

                /*
            |--------------------------------------------------------------------------
            | Order Items + Stock Update
            |--------------------------------------------------------------------------
            */

                foreach ($cart as $item) {

                    /*
                |--------------------------------------------------------------------------
                | Lock Product
                |--------------------------------------------------------------------------
                */

                    $product = Products::lockForUpdate()
                        ->find($item['id']);

                    /*
                |--------------------------------------------------------------------------
                | Product Not Found
                |--------------------------------------------------------------------------
                */

                    if (! $product) {
                        throw new \Exception('Product not found.');
                    }

                    /*
                |--------------------------------------------------------------------------
                | Check Stock
                |--------------------------------------------------------------------------
                */

                    if ($product->quantity < $item['quantity']) {

                        throw new \Exception(
                            ($product->title ?? 'A product') .
                                ' is out of stock or not enough quantity.'
                        );
                    }

                    /*
                |--------------------------------------------------------------------------
                | Create Order Item
                |--------------------------------------------------------------------------
                */

                    $order->items()->create([

                        'product_id' => $item['id'],

                        'price' => $item['price'],

                        'quantity' => $item['quantity'],

                    ]);

                    /*
                |--------------------------------------------------------------------------
                | Decrease Product Stock
                |--------------------------------------------------------------------------
                */

                    $product->decrement(
                        'quantity',
                        $item['quantity']
                    );

                    /*
                |--------------------------------------------------------------------------
                | Set Out Of Stock
                |--------------------------------------------------------------------------
                */

                    if ($product->fresh()->quantity <= 0) {

                        $product->update([
                            'status' => 'out_of_stock',
                        ]);
                    }
                }

                return $order;
            });
        } catch (\Exception $e) {

            report($e);

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }

        /*
    |--------------------------------------------------------------------------
    | Clear Cart
    |--------------------------------------------------------------------------
    */ 
        Mail::to($order->email)->send(new OrderConfirmedMail($order));

        session()->forget('cart');

     
        /*
|--------------------------------------------------------------------------
| bKash Payment
|--------------------------------------------------------------------------
*/

        if ($validated['payment_method'] === 'bkash') {

            session()->forget('cart');

            return redirect()
                ->route('order.confirm', $order->id)
                ->with('success', 'Order placed successfully!');
        }


        /*
|--------------------------------------------------------------------------
| SSLCommerz Payment
|--------------------------------------------------------------------------
*/

        if ($validated['payment_method'] === 'sslcommerz') {

            return redirect()
                ->route('sslcommerz.pay', $order->id);
        }


        /*
|--------------------------------------------------------------------------
| Cash On Delivery
|--------------------------------------------------------------------------
*/

        session()->forget('cart');

        return redirect()
            ->route('order.confirm', $order->id)
            ->with('success', 'Order placed successfully!');
    }
    public function confirm($id)
    {
        $order = Order::with('items.product')->findOrFail($id);

        return view('pages.main.order-confirm', compact('order'));
    }

    public function OrderList()
    {
        $order = Order::with('items.product')->get();
        return view('pages.dashboard.admin-dashboard.order.order-list', compact('order'));
    }

    public function pandingOrders()
    {
        $order = Order::with('items.product')->where('order_status', 'pending')->get();
        return view('pages.dashboard.admin-dashboard.order.order-list', compact('order'));
    }

    public function processingOrders()
    {
        $order = Order::with('items.product')->where('order_status', 'processing')->get();
        return view('pages.dashboard.admin-dashboard.order.processing-order', compact('order'));
    }

    public function deliveredOrders()
    {
        $order = Order::with('items.product')->where('order_status', 'delivered')->get();
        return view('pages.dashboard.admin-dashboard.order.delivered-order', compact('order'));
    }

    public function cancelledOrders()
    {
        $order = Order::with('items.product')->where('order_status', 'cancelled')->get();
        return view('pages.dashboard.admin-dashboard.order.order-list', compact('order'));
    }

    public function shippedOrders()
    {
        $order = Order::with('items.product')->where('order_status', 'shipped')->get();
        return view('pages.dashboard.admin-dashboard.order.shipping-order', compact('order'));
    }


    public function OrderDetails($id)
    {
        $order = Order::with('items.product')->findOrFail($id);
        return view('pages.dashboard.admin-dashboard.order.order-details', compact('order'));
    }



public function UpdateOrderStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
    ]);

    $order = Order::findOrFail($id);

    $oldStatus = $order->order_status;

    $order->order_status = $request->status;
    $order->save();

    // Send Delivered Email
    if ($oldStatus !== 'delivered' && $order->order_status === 'delivered') {

        try {

            Mail::to($order->email)->send(
                new OrderDeliveredMail($order)
            );

        } catch (\Throwable $e) {

            Log::error('Order delivered email failed', [
                'order_id' => $order->id,
                'error' => $e->getMessage(),
            ]);

            return back()->with(
                'error',
                'Order status updated, but delivery email could not be sent.'
            );
        }
    }

    return back()->with(
        'success',
        'Order status updated successfully.'
    );
}


}
