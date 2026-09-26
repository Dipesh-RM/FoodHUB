<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Chart;
use App\Models\MenuItem;
use App\Models\MenuItems;
use App\Models\Vendors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display cart page
     */
    public function index()
    {

        $cartItems = Chart::where('user_id', Auth::id())
                          ->with(['vendor', 'menuItem'])
                          ->get();

        $subtotal = $cartItems->sum('amount');
        $deliveryFee = 3.00;
        $serviceCharge = $subtotal * 0.10;
        $tax = ($subtotal + $deliveryFee + $serviceCharge) * 0.13;
        $total = $subtotal + $deliveryFee + $serviceCharge + $tax;

        return view('Frontend.Cart.cart-page', compact('cartItems', 'subtotal', 'deliveryFee', 'serviceCharge', 'tax', 'total'));
    }

    /**
     * Add item to cart
     */
    public function add(Request $request)
    {
        $request->validate([
            'menu_item_id' => 'required|exists:menu_items,id',
            'qty' => 'required|integer|min:1',
        ]);

        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login to add items to cart.',
                'redirect' => route('login')
            ], 401);
        }

        $menuItem = MenuItems::findOrFail($request->menu_item_id);

        // Check if item already in cart
        $existingCart = Chart::where('user_id', Auth::id())
                             ->where('menu_item_id', $request->menu_item_id)
                             ->first();

        if ($existingCart) {
            // Update quantity
            $existingCart->qty += $request->qty;
            $existingCart->amount = $existingCart->qty * $menuItem->price;
            $existingCart->save();

            $message = 'Item quantity updated in cart!';
        } else {
            // Create new cart item
            $cart = new Chart();
            $cart->user_id = Auth::id();
            $cart->vendor_id = $menuItem->vendor_id;
            $cart->menu_item_id = $request->menu_item_id;
            $cart->qty = $request->qty;
            $cart->amount = $request->qty * $menuItem->price;
            $cart->save();

            $message = 'Item added to cart successfully!';
        }

        // Get updated cart count
        $cartCount = Chart::where('user_id', Auth::id())->sum('qty');

        return response()->json([
            'success' => true,
            'message' => $message,
            'cart_count' => $cartCount,
            'item' => [
                'id' => $cart->id ?? $existingCart->id,
                'name' => $menuItem->tittle,
                'qty' => $request->qty,
                'price' => $menuItem->price,
                'amount' => $request->qty * $menuItem->price,
            ]
        ]);
    }

    /**
     * Update cart item quantity
     */
    public function update(Request $request)
    {
        $request->validate([
            'cart_id' => 'required|exists:charts,id',
            'qty' => 'required|integer|min:1',
        ]);

        $cartItem = Chart::where('id', $request->cart_id)
                         ->where('user_id', Auth::id())
                         ->firstOrFail();

        $cartItem->qty = $request->qty;
        $cartItem->amount = $request->qty * $cartItem->menuItem->price;
        $cartItem->save();

        // Recalculate totals
        $cartItems = Chart::where('user_id', Auth::id())->with('menuItem')->get();
        $subtotal = $cartItems->sum('amount');
        $cartCount = $cartItems->sum('qty');

        return response()->json([
            'success' => true,
            'message' => 'Cart updated successfully!',
            'cart_count' => $cartCount,
            'subtotal' => number_format($subtotal, 2),
            'item_total' => number_format($cartItem->amount, 2),
        ]);
    }

    /**
     * Remove item from cart
     */
    public function remove(Request $request)
    {
        $request->validate([
            'cart_id' => 'required|exists:charts,id',
        ]);

        $cartItem = Chart::where('id', $request->cart_id)
                         ->where('user_id', Auth::id())
                         ->firstOrFail();

        $cartItem->delete();

        $cartCount = Chart::where('user_id', Auth::id())->sum('qty');

        return response()->json([
            'success' => true,
            'message' => 'Item removed from cart!',
            'cart_count' => $cartCount,
        ]);
    }

    /**
     * Clear entire cart
     */
    public function clear()
    {
        Chart::where('user_id', Auth::id())->delete();

        return redirect()->route('cart')->with('success', 'Cart cleared successfully!');
    }

    /**
     * Get cart count (for AJAX)
     */
    public function getCount()
    {
        $count = Auth::check() ? Chart::where('user_id', Auth::id())->sum('qty') : 0;

        return response()->json([
            'cart_count' => $count
        ]);
    }
}
