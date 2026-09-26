<?php
// app/Http/Controllers/Frontend/OrderController.php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\MenuItem;
use App\Models\MenuItems;
use App\Models\ShippingAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Show all orders
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $orders = Order::where('user_id', Auth::id())
                       ->with(['items.menuItem', 'vendors', 'shippingAddress'])
                       ->orderBy('created_at', 'desc')
                       ->paginate(10);

        return view('Frontend.Order.my-orders', compact('orders'));
    }

    /**
     * Show single order
     */
    public function show($id)
    {
        $order = Order::where('id', $id)
                      ->where('user_id', Auth::id())
                      ->with(['items.menuItem', 'vendors', 'shippingAddress'])
                      ->firstOrFail();

        return view('Frontend.Order.order_detail', compact('order'));
    }

    /**
     * Place order - WITH order_id LINKING
     */
    public function placeOrder(Request $request)
    {
        $validated = $request->validate([
            'shipping_address_id' => 'required|exists:shipping_addresses,id',
            'payment_method' => 'required|in:cod,online',
            'cart_data' => 'required|string',
        ]);

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

        try {
            DB::beginTransaction();

            // Group cart items by vendor
            $itemsByVendor = [];
            foreach ($cart as $item) {
                $menuItem = MenuItems::find($item['id']);
                if ($menuItem) {
                    $vendorId = $menuItem->vendor_id;
                    if (!isset($itemsByVendor[$vendorId])) {
                        $itemsByVendor[$vendorId] = [];
                    }
                    $itemsByVendor[$vendorId][] = [
                        'menu_item' => $menuItem,
                        'quantity' => $item['quantity'],
                        'price' => $item['price'] ?? $menuItem->price,
                    ];
                }
            }

            $orders = [];

            foreach ($itemsByVendor as $vendorId => $items) {
                $subtotal = 0;
                foreach ($items as $item) {
                    $subtotal += $item['price'] * $item['quantity'];
                }

                $deliveryFee = 3.00;
                $serviceCharge = $subtotal * 0.10;
                $tax = ($subtotal + $deliveryFee + $serviceCharge) * 0.13;
                $total = $subtotal + $deliveryFee + $serviceCharge + $tax;

                // Create Order
                $order = Order::create([
                    'user_id' => Auth::id(),
                    'shipping_address_id' => $address->id,
                    'vendor_id' => $vendorId,
                    'total_amount' => $total,
                    'status' => 'pending',
                    'payment_method' => $validated['payment_method'],
                    'payment_status' => 'pending',
                ]);

                // Create Order Items - LINKING WITH order_id
                foreach ($items as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,          // ← KEY FIX
                        'user_id' => Auth::id(),
                        'vendor_id' => $vendorId,
                        'menu_item_id' => $item['menu_item']->id,
                        'qty' => $item['quantity'],
                    ]);
                }

                $orders[] = $order;
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Order placed successfully!',
                'order_id' => $orders[0]->id,
                'redirect' => route('order.success', $orders[0]->id),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to place order: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Cancel order
     */
    public function cancel(Request $request, $id)
    {
        $order = Order::where('id', $id)
                      ->where('user_id', Auth::id())
                      ->firstOrFail();

        if (!$order->canCancel()) {
            return response()->json([
                'success' => false,
                'message' => 'This order cannot be cancelled. It is already ' . $order->status . '.',
            ], 422);
        }

        $validated = $request->validate([
            'reason' => 'nullable|string|max:500',
        ]);

        $order->update(['status' => 'cancelled']);

        \Log::info('Order cancelled', [
            'order_id' => $order->id,
            'user_id' => Auth::id(),
            'reason' => $validated['reason'] ?? 'No reason provided',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Order cancelled successfully!',
        ]);
    }

    /**
     * Order success
     */
    public function success($id)
    {
        $order = Order::where('id', $id)
                      ->where('user_id', Auth::id())
                      ->with(['items.menuItem', 'vendors', 'shippingAddress'])
                      ->firstOrFail();

        return view('Frontend.Order.order-success', compact('order'));
    }
}
