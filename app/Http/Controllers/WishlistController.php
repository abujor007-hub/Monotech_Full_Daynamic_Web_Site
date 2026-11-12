<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;

class WishlistController extends Controller
{
    // Add or Remove Wishlist
    public function toggle($id)
    {
        $userId = auth()->id();

        $wishlist = Wishlist::where('user_id', $userId)
            ->where('product_id', $id)
            ->first();

        if ($wishlist) {
            $wishlist->delete();

            return back()->with('success', 'Removed from Wishlist!');
        }

        Wishlist::create([
            'user_id' => $userId,
            'product_id' => $id,
        ]);

        return back()->with('success', 'Added to Wishlist!');
    }

    // Show Wishlist Products
    public function index()
    {
        $wishlists = Wishlist::with('product')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('pages.main.wishlist', compact('wishlists'));
    }
}
