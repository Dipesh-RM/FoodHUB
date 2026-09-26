<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ShippingAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * Show checkout page
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to checkout.');
        }

        $user = Auth::user();
        $addresses = ShippingAddress::where('user_id', $user->id)->get();
        $defaultAddress = $addresses->where('is_default', true)->first();

        return view('Frontend.Checkout.checkout',compact('addresses', 'defaultAddress'));
    }

    /**
     * Save new shipping address
     */
    public function storeAddress(Request $request)
    {
        $validated = $request->validate([
            'tittle' => 'required|string|max:255',
            'contact_no' => 'required|string|max:20',
            'full_address' => 'required|string|max:500',
            'is_default' => 'nullable|boolean',
        ]);

        $address = ShippingAddress::create([
            'user_id' => Auth::id(),
            'tittle' => $validated['tittle'],
            'contact_no' => $validated['contact_no'],
            'full_address' => $validated['full_address'],
            'is_default' => $request->is_default ?? false,
        ]);

        // If set as default, update others
        if ($request->is_default) {
            $address->setAsDefault();
        }

        return response()->json([
            'success' => true,
            'message' => 'Address added successfully!',
            'address' => $address,
        ]);
    }

    /**
     * Update shipping address
     */
    public function updateAddress(Request $request, $id)
    {
        $address = ShippingAddress::where('id', $id)
                                  ->where('user_id', Auth::id())
                                  ->firstOrFail();

        $validated = $request->validate([
            'tittle' => 'required|string|max:255',
            'contact_no' => 'required|string|max:20',
            'full_address' => 'required|string|max:500',
        ]);

        $address->update($validated);

        if ($request->is_default) {
            $address->setAsDefault();
        }

        return response()->json([
            'success' => true,
            'message' => 'Address updated successfully!',
        ]);
    }

    /**
     * Delete shipping address
     */
    public function deleteAddress($id)
    {
        $address = ShippingAddress::where('id', $id)
                                  ->where('user_id', Auth::id())
                                  ->firstOrFail();

        $address->delete();

        return response()->json([
            'success' => true,
            'message' => 'Address deleted successfully!',
        ]);
    }

    /**
     * Place order
     */
    public function placeOrder(Request $request)
    {
        $validated = $request->validate([
            'shipping_address_id' => 'required|exists:shipping_addresses,id',
            'payment_method' => 'required|in:cod,online',
            'cart_data' => 'required|string',
        ]);

        // Verify address belongs to user
        $address = ShippingAddress::where('id', $validated['shipping_address_id'])
                                  ->where('user_id', Auth::id())
                                  ->firstOrFail();

        $cart = json_decode($validated['cart_data'], true);

        if (empty($cart)) {
            return response()->json([
                'success' => false,
                'message' => 'Your cart is empty.',
            ], 422);
        }

        // Here you would create the order in database
        // For now, just return success

        if ($validated['payment_method'] === 'online') {
            // Handle online payment
            return response()->json([
                'success' => true,
                'message' => 'Redirecting to payment gateway...',
                'redirect' => route('payment.process'),
                'payment_method' => 'online',
            ]);
        }

        // COD - place order directly
        return response()->json([
            'success' => true,
            'message' => 'Order placed successfully!',
            'order_id' => 'ORD-' . date('Ymd') . '-' . rand(1000, 9999),
            'redirect' => route('/my-orders'),
        ]);
    }
}
