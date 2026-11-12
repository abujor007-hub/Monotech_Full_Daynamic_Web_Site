<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserCartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        $subtotal = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        $totalItems = collect($cart)->sum('quantity');

        return view(
            'pages.dashboard.user-dashboard.user-cart',
            compact('cart', 'subtotal', 'totalItems')
        );
    }
}