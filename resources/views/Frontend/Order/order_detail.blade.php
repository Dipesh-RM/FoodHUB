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
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <a href="{{ route('my-orders') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-primary mb-6">
            <i class="fas fa-arrow-left"></i> Back to My Orders
        </a>

        <!-- Order Header -->
        <div class="bg-white rounded-xl shadow-soft p-6 mb-6">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div>
                    <p class="text-sm text-gray-500">Order #</p>
                    <p class="text-xl font-heading font-bold text-secondary">{{ $order->id }}</p>
                    <p class="text-xs text-gray-500 mt-1">
                        {{ $order->created_at->format('F d, Y • h:i A') }}
                    </p>
                </div>
                <span class="px-4 py-2 rounded-full text-sm font-medium {{ $order->status_badge }}">
                    {{ $order->status_label }}
                </span>
            </div>
        </div>

        <!-- Items -->
        <div class="bg-white rounded-xl shadow-soft p-6 mb-6">
            <h3 class="text-lg font-heading font-bold text-secondary mb-4">Order Items</h3>

            <div class="space-y-3">
                @foreach($order->items as $item)
                <div class="flex items-center gap-3 py-3 border-b border-gray-100 last:border-0">
                    <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center text-primary font-bold">
                        {{ $item->qty }}x
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-gray-800">
                            {{ $item->menuItem->tittle ?? 'Unknown' }}
                        </p>
                        <p class="text-sm text-gray-500">
                            ${{ number_format($item->menuItem->price ?? 0, 2) }} each
                        </p>
                    </div>
                    <span class="font-semibold text-gray-700">
                        ${{ number_format(($item->menuItem->price ?? 0) * $item->qty, 2) }}
                    </span>
                </div>
                @endforeach
            </div>

            <div class="mt-4 pt-4 border-t border-gray-200">
                <div class="flex justify-between text-lg font-heading font-bold text-secondary">
                    <span>Total</span>
                    <span class="text-primary">${{ number_format($order->total_amount, 2) }}</span>
                </div>
            </div>
        </div>

        <!-- Delivery & Payment -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="bg-white rounded-xl shadow-soft p-6">
                <h3 class="text-lg font-heading font-bold text-secondary mb-4">
                    <i class="fas fa-map-marker-alt text-primary mr-2"></i>
                    Delivery Address
                </h3>
                <div class="space-y-2">
                    <p class="font-medium text-gray-800">
                        {{ $order->shippingAddress->tittle ?? 'Address' }}
                    </p>
                    <p class="text-sm text-gray-600">
                        <i class="fas fa-phone text-primary w-4"></i>
                        {{ $order->shippingAddress->contact_no ?? 'N/A' }}
                    </p>
                    <p class="text-sm text-gray-600">
                        <i class="fas fa-home text-primary w-4"></i>
                        {{ $order->shippingAddress->full_address ?? 'N/A' }}
                    </p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-soft p-6">
                <h3 class="text-lg font-heading font-bold text-secondary mb-4">
                    <i class="fas fa-credit-card text-primary mr-2"></i>
                    Payment
                </h3>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-500">Method</span>
                        <span class="text-sm font-medium text-gray-800">
                            {{ $order->payment_method === 'cod' ? 'Cash on Delivery' : 'Online Payment' }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-500">Status</span>
                        <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $order->payment_status_badge }}">
                            {{ ucfirst($order->payment_status) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cancel Button -->
        @if($order->canCancel())
        <div class="bg-white rounded-xl shadow-soft p-6">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div>
                    <h3 class="font-medium text-gray-800">Need to cancel this order?</h3>
                    <p class="text-sm text-gray-500">You can cancel before it's delivered.</p>
                </div>
                <button onclick="openCancelModal()"
                        class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2.5 px-6 rounded-lg">
                    <i class="fas fa-times mr-2"></i> Cancel Order
                </button>
            </div>
        </div>
        @endif

    </div>
</section>

<!-- Cancel Modal -->
<div id="cancelModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm">
    <div class="bg-white rounded-2xl p-6 max-w-md w-full mx-4 shadow-2xl">
        <div class="text-center mb-4">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-3">
                <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
            </div>
            <h3 class="text-xl font-heading font-bold text-secondary">Cancel Order?</h3>
            <p class="text-gray-500 text-sm mt-1">This action cannot be undone.</p>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Reason (optional)</label>
            <textarea id="cancel-reason" rows="3" class="input-primary" placeholder="Why?"></textarea>
        </div>

        <div class="flex gap-3">
            <button type="button" onclick="closeCancelModal()" class="btn-outline flex-1 py-2.5">Keep</button>
            <button type="button" onclick="confirmCancel()" id="cancel-submit-btn"
                    class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2.5 px-6 rounded-lg flex-1">
                <i class="fas fa-times mr-1"></i> Cancel
            </button>
        </div>
    </div>
</div>

<script>
    function openCancelModal() {
        document.getElementById('cancel-reason').value = '';
        document.getElementById('cancelModal').classList.remove('hidden');
        document.getElementById('cancelModal').classList.add('flex');
    }

    function closeCancelModal() {
        document.getElementById('cancelModal').classList.add('hidden');
        document.getElementById('cancelModal').classList.remove('flex');
    }

    function confirmCancel() {
        const reason = document.getElementById('cancel-reason').value;
        const btn = document.getElementById('cancel-submit-btn');
        const originalText = btn.innerHTML;

        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>';

        fetch(`/my-orders/{{ $order->id }}/cancel`, {
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
