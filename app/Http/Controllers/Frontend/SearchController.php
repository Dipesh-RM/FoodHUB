<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Vendors;

use App\Models\Category;
use App\Models\MenuItems;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Handle search functionality
     */
    public function index(Request $request)
    {
        $query = $request->get('q');
        $location = $request->get('location');
        $cuisine = $request->get('cuisine');

        // Start query for vendors (hotels)
        $vendors = Vendors::where('status', 'approved')
                          ->with(['menuItems' => function($q) {
                              $q->where('status', 'enable');
                          }]);

        // Search by food name (menu items)
        if ($query) {
            $vendors->where(function($q) use ($query) {
                $q->where('company_name', 'LIKE', "%{$query}%")
                  ->orWhere('name', 'LIKE', "%{$query}%")
                  ->orWhereHas('menuItems', function($menu) use ($query) {
                      $menu->where('tittle', 'LIKE', "%{$query}%")
                           ->orWhere('description', 'LIKE', "%{$query}%");
                  });
            });
        }

        // Search by location
        if ($location) {
            $vendors->where(function($q) use ($location) {
                $q->where('city', 'LIKE', "%{$location}%")
                  ->orWhere('address', 'LIKE', "%{$location}%");
            });
        }

        // Search by cuisine (category)
        if ($cuisine) {
            $vendors->whereHas('categories', function($cat) use ($cuisine) {
                $cat->where('name', 'LIKE', "%{$cuisine}%");
            });
        }

        // Get results
        $vendors = $vendors->paginate(12);

        // Get popular menu items (for display)
        $popularItems = MenuItems::where('status', 'enable')
                                ->with('vendors')
                                ->orderBy('created_at', 'desc')
                                ->limit(8)
                                ->get();

        // Get categories for filter
        $categories = Category::with('vendors')
                              ->whereHas('vendors', function($q) {
                                  $q->where('status', 'approved');
                              })
                              ->distinct()
                              ->pluck('name');

        return view('HomePage.search-results', compact('vendors', 'popularItems', 'categories', 'query', 'location', 'cuisine'));
    }
}
