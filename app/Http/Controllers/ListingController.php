<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Listing;
use JWTAuth;

class ListingController extends Controller
{
    /**
     * create a new listing for the user
     * @param, name: string, title: string, info: string, url: string
     */
    public function create(Request $request) {
        $user = JWTAuth::parseToken()->toUser();

        // create a listing
        $listing = new Listing();
        $listing->user_id = $user->id;
        $listing->name = $request->input('name');
        $listing->url = $request->input('url');
        $listing->img = $request->input('img');
        $listing->title = $request->input('title');
        $listing->info = $request->input('info');

        $listing->save();
        return response()->json([
            'listing' => $listing
        ], 201);
    }
}
