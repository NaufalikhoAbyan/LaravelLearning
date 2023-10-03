<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RealtorListingController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Listing::class, 'listing');
    }

    public function index(Request $request)
    {
        $filters = [
            'deleted' => $request->boolean('deleted'),
            'by' => $request->get('by'),
            'order' => $request->get('order'),
        ];

        return inertia('Realtor/Index', [
            'listings' => Auth::user()->listings()->filter($filters)->paginate(6)->withQueryString(),
            'filters' => $filters,
        ]);
    }

    public function destroy(Listing $listing)
    {
        $listing->deleteOrFail();

        return redirect()->back()->with('success', 'Listing was deleted!');
    }
}
