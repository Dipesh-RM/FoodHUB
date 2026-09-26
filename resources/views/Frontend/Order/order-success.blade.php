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

<section class="py-16 bg-gray-50 min-h-screen">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="bg-white rounded-2xl shadow-xl p-8 text-center">
            <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-check-circle text-5xl text-green-500"></i>
            </div>

            <h1 class="text-3xl font-heading font-bold text-secondary mb-2">Order Placed! 🎉</h1>
            <p class="text-gray-500 mb-6">Thank you for your order. We'll start preparing it right away.</p>

            <div class="bg-primary-bg rounded-xl p-6 mb-6 text-left">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-sm text-gray-600">Order #</span>
                    <span class="font-semibold text-secondary">{{ $order->id }}</span>
                </div>
                <div class="flex items-center justify-between mb-4">
                    <span class="text-sm text-gray-600">Total</span>
                    <span class="text-lg font-heading font-bold text-primary">
                        ${{ number_format($order->total_amount, 2) }}
                    </span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Payment</span>
                    <span class="font-medium text-secondary">
                        {{ $order->payment_method === 'cod' ? 'Cash on Delivery' : 'Online Payment' }}
                    </span>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row justify-center gap-3">
                <a href="{{ route('my-orders.show', $order->id) }}" class="btn-primary py-3 px-6">
                    <i class="fas fa-eye mr-2"></i> View Order
                </a>
                <a href="{{ route('hotels.index') }}" class="btn-outline py-3 px-6">
                    <i class="fas fa-utensils mr-2"></i> Continue Shopping
                </a>
            </div>
        </div>
    </div>
</section>


</body>
</html>
