<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Vendors;
use App\Models\Category;
use App\Models\MenuItem;
use App\Models\MenuItems;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * Show hotel menu with categories and items
     */
    public function menu($id)
    {
        // Get hotel details
        $hotel = Vendors::findOrFail($id);

        // Get categories for this vendor with menu items
        $categories = Category::where('vendor_id', $id)
                              ->with(['menuItems' => function($query) {
                                  $query->where('status', 'enable')
                                        ->orderBy('tittle', 'asc');
                              }])
                              ->withCount(['menuItems' => function($query) {
                                  $query->where('status', 'enable');
                              }])
                              ->get();

        // Get all menu items for this vendor (optional)
        $menuItems = MenuItems::where('vendor_id', $id)
                             ->where('status', 'enable')
                             ->with('category')
                             ->get();

        return view('HomePage.hotel-menu', compact('hotel', 'categories', 'menuItems'));
    }
}
