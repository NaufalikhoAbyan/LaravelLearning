<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class RealtorListingAcceptOfferController extends Controller
{
    public function __invoke(Offer $offer)
    {
        // Accept the selected offer
        $offer->update(['accepted_at' => now()]);

        // Reject all other offers
        $offer->listing->offers()->except($offer)->update(['rejected_at' => now()]);

        // Mark the listing as sold
        $offer->listing->sold_at = now();
        $offer->listing->save();

        return redirect()->back()->with('success', "Offer #{$offer->id} accepted! other offer rejected.");
    }
}
