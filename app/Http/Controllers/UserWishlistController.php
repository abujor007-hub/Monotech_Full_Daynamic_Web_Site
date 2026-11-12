<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Wishlist;

class UserWishlistController extends Controller
{
     public function index()
    {
        $wishlists = Wishlist::with('product')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view(
            'pages.dashboard.user-dashboard.user-wishlist',
            compact('wishlists')
        );
    }
}
