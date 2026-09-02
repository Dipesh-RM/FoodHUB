<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\MenuItems;
use App\Models\Vendors;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home(){
     // Get featured hotels
        $featuredHotels = Vendors::where('status', 'approved')
                                 ->with(['menuItems' => function($query) {
                                     $query->where('status', 'enable');
                                 }])
                                 ->take(4)
                                ->get();

        // Get popular menu items
        $popularItems = MenuItems::where('status', 'enable')
                                ->with('vendors')
                                ->orderBy('created_at', 'desc')
                                ->take(8)
                                ->get();

        // Statistics
        $totalVendors = Vendors::where('status', 'approved')->count();
        $totalMenuItems = MenuItems::where('status', 'enable')->count();
        $totalOrders = 0; // You can calculate from orders table

        return view('HomePage.home', compact(
            'featuredHotels',
            'popularItems',
            'totalVendors',
            'totalMenuItems',
            'totalOrders'
        ));
}
}
