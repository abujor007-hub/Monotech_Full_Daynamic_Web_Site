<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class UserOrderController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $orders = Order::with('items.product')
            ->where('user_id', $userId)
            ->latest()
            ->paginate(10);

        $totalOrders = Order::where('user_id', $userId)->count();

        $pendingOrders = Order::where('user_id', $userId)
            ->where('order_status', 'pending')
            ->count();

        return view('pages.dashboard.user-dashboard.order.orders', compact(
            'orders',
            'totalOrders',
            'pendingOrders'
        ));
    }

    public function show($id)
    {
        $order = Order::with('items.product')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('pages.dashboard.user-dashboard.order.order-details', compact('order'));
    }
}