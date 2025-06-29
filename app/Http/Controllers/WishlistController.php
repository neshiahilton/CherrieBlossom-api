<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        return view('pages.wishlist'); // ← arahkan ke folder 'pages'
    }

    public function add(Request $request)
    {
        $request->validate([
            'bouquet_id' => 'required|exists:bouquets,id',
        ]);

        $wishlist = Wishlist::firstOrCreate([
            'user_id' => auth()->id(),
            'bouquet_id' => $request->bouquet_id,
        ]);

        return response()->json([
            'message' => 'Added to wishlist',
            'data' => $wishlist
        ]);
    }


}
