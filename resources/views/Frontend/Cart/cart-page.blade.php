
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - Chakhajza</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>

    <!-- NAVBAR WITH CART BADGE -->
    <nav class="sticky top-0 z-50 bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 md:h-20">
                <a href="/" class="flex items-center space-x-2">
                    <span class="text-2xl font-heading font-bold text-primary">Chakhajza</span>
                </a>
                <div class="flex items-center space-x-4">
                    <a href="/cart" class="relative text-gray-700 hover:text-primary p-2">
                        <i class="fas fa-shopping-bag text-xl"></i>
                        <span class="absolute -top-0.5 -right-0.5 bg-primary text-white text-[10px] font-bold w-5 h-5 rounded-full flex items-center justify-center shadow-lg cart-badge">
                            0
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <!-- CART CONTENT -->
    <section class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-heading font-bold text-secondary mb-6">Shopping Cart</h1>

            <!-- Cart Container -->
            <div id="cart-container"></div>

            <!-- Order Summary -->
            <div id="order-summary" class="mt-8 max-w-md ml-auto"></div>
        </div>
    </section>
</body>
</html>
