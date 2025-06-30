<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bouquet;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function index(Request $request)
    {
        $ids = explode(',', $request->input('ids'));

        if (empty($ids) || $ids === ['']) {
            return response()->json([
                'status' => true,
                'data' => []
            ]);
        }

        $bouquets = Bouquet::whereIn('id', $ids)->get();

        return response()->json([
            'status' => true,
            'data' => $bouquets
        ]);
    }

    public function store(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'bouquet_id' => 'required|exists:bouquets,id',
        ]);

        $exists = Wishlist::where('user_id', $user->id)
                        ->where('bouquet_id', $validated['bouquet_id'])
                        ->exists();

        if (!$exists) {
            Wishlist::create([
                'user_id' => $user->id,
                'bouquet_id' => $validated['bouquet_id'],
            ]);
        }

        return response()->json(['status' => true, 'message' => 'Wishlist updated']);
    }

    public function destroy(Request $request, $bouquet_id)
    {
        $user = $request->user();

        Wishlist::where('user_id', $user->id)
                ->where('bouquet_id', $bouquet_id)
                ->delete();

        return response()->json(['status' => true, 'message' => 'Removed from wishlist']);
    }

    public function userWishlist(Request $request)
    {
        $user = $request->user();

        $wishlists = $user->wishlists()->with('bouquet')->get();
        $bouquets = $wishlists->map(function ($wishlist) {
            return $wishlist->bouquet;
        })->filter(); // buang null


        return response()->json([
            'status' => true,
            'data' => $bouquets
        ]);
    }


}
