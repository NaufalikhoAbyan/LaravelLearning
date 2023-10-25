<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function store(Listing $listing, Request $request)
    {
        $listing->offers()->save(
            Offer::make($request->validate([
                'amount' => 'required|integer|min:1'
            ]))->user()->associate($request->user())
        );

        return redirect()->back()->with('success', 'Offer was made successfully!');
    }
}
