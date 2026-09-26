<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
     @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>


<section class="py-8 md:py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-3xl font-heading font-bold text-secondary">My Orders</h1>
                <p class="text-gray-500 text-sm mt-1">Track and manage your orders</p>
            </div>
            <a href="{{ route('hotels.index') }}" class="btn-primary py-2 px-4 text-sm">
                <i class="fas fa-plus mr-1"></i> New Order
            </a>
        </div>

        @if($orders->count() > 0)
            <div class="space-y-4">
                @foreach($orders as $order)
                <div class="bg-white rounded-xl shadow-soft overflow-hidden">

                    <!-- Header -->
                    <div class="p-4 border-b border-gray-100 flex flex-wrap items-center justify-between gap-3">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center text-primary">
                                <i class="fas fa-receipt text-xl"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800">Order #{{ $order->id }}</p>
                                <p class="text-xs text-gray-500">
                                    <i class="fas fa-calendar text-primary mr-1"></i>
                                    {{ $order->created_at->format('M d, Y • h:i A') }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <span class="px-3 py-1 rounded-full text-xs font-medium {{ $order->status_badge }}">
                                {{ $order->status_label }}
                            </span>
                            <span class="px-3 py-1 rounded-full text-xs font-medium {{ $order->payment_status_badge }}">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            <!-- Items - NOW SHOWS ONLY THIS ORDER'S ITEMS -->
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 mb-2">Items</h4>
                                <div class="space-y-2">
                                    @forelse($order->items as $item)
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center text-gray-500 text-xs font-bold">
                                            {{ $item->qty }}x
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-sm font-medium text-gray-800">
                                                {{ $item->menuItem->tittle ?? 'Unknown Item' }}
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                Rs.{{ number_format($item->menuItem->price) }} each
                                            </p>
                                        </div>
                                        <span class="text-sm font-semibold text-gray-700">
                                            Rs.{{ number_format(($item->menuItem->price ?? 0)) }}
                                        </span>
                                    </div>
                                    @empty
                                    <p class="text-sm text-gray-500">No items</p>
                                    @endforelse
                                </div>
                            </div>

                            <!-- Delivery -->
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 mb-2">Delivery</h4>
                                <div class="space-y-1 text-sm">
                                    <p class="text-gray-700">
                                        <i class="fas fa-store text-primary w-4"></i>
                                        {{ $order->vendors->company_name ?? 'Unknown' }}
                                    </p>
                                    <p class="text-gray-700">
                                        <i class="fas fa-phone text-primary w-4"></i>
                                        {{ $order->shippingAddress->contact_no ?? 'N/A' }}
                                    </p>
                                    <p class="text-gray-700 line-clamp-2">
                                        <i class="fas fa-map-marker-alt text-primary w-4"></i>
                                        {{ $order->shippingAddress->full_address ?? 'N/A' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="px-4 py-3 bg-gray-50 border-t border-gray-100 flex flex-wrap items-center justify-between gap-3">
                        <div class="flex items-center gap-4">
                            <div>
                                <p class="text-xs text-gray-500">Total</p>
                                <p class="text-lg font-heading font-bold text-primary">
                                    Rs.{{ number_format($order->total_amount, 2) }}
                                </p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Payment</p>
                                <p class="text-sm font-medium text-gray-700">
                                    {{ $order->payment_method === 'cod' ? 'Cash on Delivery' : 'Online Payment' }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <a href="{{ route('my-orders.show', $order->id) }}"
                               class="btn-outline py-1.5 px-4 text-sm">
                                <i class="fas fa-eye mr-1"></i> View
                            </a>

                            @if($order->canCancel())
                            <button onclick="openCancelModal({{ $order->id }})"
                                    class="bg-red-500 hover:bg-red-600 text-white font-medium py-1.5 px-4 rounded-lg text-sm">
                                <i class="fas fa-times mr-1"></i> Cancel
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $orders->links() }}
            </div>

        @else
            <div class="text-center py-16 bg-white rounded-xl shadow-soft">
                <div class="text-6xl mb-4">📦</div>
                <h3 class="text-2xl font-heading font-bold text-secondary mb-2">No Orders Yet</h3>
                <p class="text-gray-500 mb-6">You haven't placed any orders yet.</p>
                <a href="{{ route('hotels.index') }}" class="btn-primary inline-flex items-center gap-2">
                    <i class="fas fa-utensils"></i> Browse Hotels
                </a>
            </div>
        @endif
    </div>
</section>

{{-- Cancel Modal (same as before) --}}
<div id="cancelModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm">
    <div class="bg-white rounded-2xl p-6 max-w-md w-full mx-4 shadow-2xl">
        <div class="text-center mb-4">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-3">
                <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
            </div>
            <h3 class="text-xl font-heading font-bold text-secondary">Cancel Order?</h3>
            <p class="text-gray-500 text-sm mt-1">This action cannot be undone.</p>
        </div>

        <form id="cancel-form" onsubmit="submitCancel(event)">
            @csrf
            <input type="hidden" id="cancel-order-id">

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Reason (optional)</label>
                <textarea id="cancel-reason" rows="3" class="input-primary" placeholder="Why?"></textarea>
            </div>

            <div class="flex gap-3">
                <button type="button" onclick="closeCancelModal()" class="btn-outline flex-1 py-2.5">Keep</button>
                <button type="submit" id="cancel-submit-btn"
                        class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2.5 px-6 rounded-lg flex-1">
                    <i class="fas fa-times mr-1"></i> Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openCancelModal(orderId) {
        document.getElementById('cancel-order-id').value = orderId;
        document.getElementById('cancel-reason').value = '';
        document.getElementById('cancelModal').classList.remove('hidden');
        document.getElementById('cancelModal').classList.add('flex');
    }

    function closeCancelModal() {
        document.getElementById('cancelModal').classList.add('hidden');
        document.getElementById('cancelModal').classList.remove('flex');
    }

    function submitCancel(e) {
        e.preventDefault();
        const orderId = document.getElementById('cancel-order-id').value;
        const reason = document.getElementById('cancel-reason').value;
        const btn = document.getElementById('cancel-submit-btn');
        const originalText = btn.innerHTML;

        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>';

        fetch(`/my-orders/${orderId}/cancel`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ reason })
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                closeCancelModal();
                alert(data.message);
                location.reload();
            } else {
                alert(data.message || 'Error');
                btn.disabled = false;
                btn.innerHTML = originalText;
            }
        })
        .catch(() => {
            alert('Something went wrong!');
            btn.disabled = false;
            btn.innerHTML = originalText;
        });
    }

    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeCancelModal(); });
    document.addEventListener('click', e => { if (e.target.id === 'cancelModal') closeCancelModal(); });
</script>


</body>
</html>
