<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Products;
use App\Models\User;
use App\Models\Wishlist;

class DashboardController extends Controller
{
    public function dashboard()
    {
        if (auth()->user()->user_type == 'admin') {

            // Admin Dashboard Data

            $totalSales = Order::where('order_status', '!=', 'cancelled')
                ->sum('total');

            $totalOrders = Order::count();

            $totalProducts = Products::count();

            $totalUsers = User::count();

            $pendingOrders = Order::where('order_status', 'pending')->count();

            $processingOrders = Order::where('order_status', 'processing')->count();

            $completedOrders = Order::where('order_status', 'delivered')->count();

            $cancelledOrders = Order::where('order_status', 'cancelled')->count();

            $recentOrders = Order::latest()->take(10)->get();

            return view(
                'pages.dashboard.admin-dashboard.admin-dashboard',
                compact(
                    'totalSales',
                    'totalOrders',
                    'totalProducts',
                    'totalUsers',
                    'pendingOrders',
                    'processingOrders',
                    'completedOrders',
                    'cancelledOrders',
                    'recentOrders'
                )
            );

        } else {

            // User Dashboard Data

            $userId = auth()->id();

            $totalOrders = Order::where('user_id', $userId)->count();

            $pendingOrders = Order::where('user_id', $userId)
                ->where('order_status', 'pending')
                ->count();

            $wishlistItems = Wishlist::where('user_id', $userId)->count();

            $recentOrders = Order::where('user_id', $userId)
                ->latest()
                ->take(5)
                ->get();

            return view(
                'pages.dashboard.user-dashboard.user-dashboard',
                compact(
                    'totalOrders',
                    'pendingOrders',
                    'wishlistItems',
                    'recentOrders'
                )
            );
        }
    }
}
