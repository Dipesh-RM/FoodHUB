// ============================================
// MASTER CART SYSTEM - ONE FILE FOR ALL PAGES
// ============================================

// Get cart from localStorage
function getCart() {
    try {
        return JSON.parse(localStorage.getItem('cart') || '[]');
    } catch {
        return [];
    }
}

// Save cart to localStorage
function saveCart(cart) {
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartBadge();

    // Auto re-render cart if on cart page
    if (document.getElementById('cart-container')) {
        renderCart();
    }

    return cart;
}

// ============================================
// UPDATE CART BADGE - WORKS ON ALL PAGES
// ============================================
function updateCartBadge() {
    const cart = getCart();
    const totalItems = cart.reduce((sum, item) => sum + (item.quantity || 0), 0);

    // Update ALL cart badges on the page
    document.querySelectorAll('.cart-badge').forEach(badge => {
        badge.textContent = totalItems;
    });

    console.log('Cart badge updated to:', totalItems); // For debugging
    return totalItems;
}

// ============================================
// ADD TO CART - MAIN FUNCTION
function addToCart(itemId, itemName, itemPrice, itemImage = '', quantity = 1) {
    if (!itemId || !itemName || isNaN(itemPrice)) {
        console.error('Invalid item data:', { itemId, itemName, itemPrice });
        return;
    }

    let cart = getCart();
    const existingItem = cart.find(item => item.id == itemId);

    if (existingItem) {
        existingItem.quantity += quantity;
        // Update image in case it was missing before
        if (!existingItem.image && itemImage) {
            existingItem.image = itemImage;
        }
    } else {
        cart.push({
            id: parseInt(itemId),
            name: itemName,
            price: parseFloat(itemPrice),
            image: itemImage,   // <-- store the image
            quantity: quantity
        });
    }

    saveCart(cart);
    updateCartBadge();
    showNotification(`${itemName} added to cart!`, 'success');
}

// ============================================
// REMOVE FROM CART
// ============================================
function removeFromCart(itemId) {
    if (!confirm('Are you sure you want to remove this item?')) return;

    let cart = getCart();
    cart = cart.filter(item => item.id != itemId);
    saveCart(cart);
    updateCartBadge();
    showNotification('Item removed from cart!', 'success');
}

// ============================================
// UPDATE QUANTITY
// ============================================
function updateCartQuantity(itemId, newQuantity) {
    if (newQuantity < 1) {
        removeFromCart(itemId);
        return;
    }

    let cart = getCart();
    const item = cart.find(item => item.id == itemId);
    if (item) {
        item.quantity = newQuantity;
        saveCart(cart);
        updateCartBadge();
    }
}

// ============================================
// CLEAR CART
// ============================================
function clearCart() {
    if (!confirm('Are you sure you want to clear your cart?')) return;
    saveCart([]); // This will trigger the refresh
    showNotification('Cart cleared!', 'info');
}

// ============================================
// RENDER CART - FOR CART PAGE
// ============================================
function renderCart() {
    const cart = getCart();
    const container = document.getElementById('cart-container');
    const summary = document.getElementById('order-summary');

    if (!container) {
        console.warn('Cart container not found');
        return;
    }

    if (cart.length === 0) {
        container.innerHTML = `
            <div class="text-center py-16 bg-white rounded-xl shadow-soft">
                <div class="text-6xl mb-4">🛒</div>
                <h3 class="text-2xl font-heading font-bold text-secondary mb-2">Your Cart is Empty</h3>
                <p class="text-gray-500 mb-6">Looks like you haven't added any items to your cart yet.</p>
                <a href="/hotels" class="btn-primary inline-flex items-center gap-2">
                    <i class="fas fa-utensils"></i> Browse Hotels
                </a>
            </div>
        `;
        if (summary) summary.innerHTML = '';
        updateCartBadge();
        return;
    }

    // Calculate totals
    let subtotal = 0;
    let totalItems = 0;
    cart.forEach(item => {
        subtotal += item.price * item.quantity;
        totalItems += item.quantity;
    });

    const deliveryFee = 3.00;
    const serviceCharge = subtotal * 0.10;
    const tax = (subtotal + deliveryFee + serviceCharge) * 0.13;
    const total = subtotal + deliveryFee + serviceCharge + tax;

    // Build cart HTML
    let itemsHtml = `
        <div class="bg-white rounded-xl shadow-soft overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Item</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
    `;

    cart.forEach(item => {
        const itemTotal = (item.price * item.quantity).toFixed(2);
        itemsHtml += `
            <tr class="hover:bg-gray-50 transition-colors duration-200" id="cart-row-${item.id}">
                <td class="px-4 py-4">
                    <div class="flex items-center gap-3">
                        <img src="${item.image || 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=60&h=60&fit=crop'}"
                             alt="${item.name}"
                             class="w-12 h-12 rounded-lg object-cover">
                        <div>
                            <p class="font-semibold text-gray-800 text-sm">${item.name}</p>
                            <p class="text-xs text-gray-500">${item.vendor || 'Hotel'}</p>
                        </div>
                    </div>
                </td>
                <td class="px-4 py-4 text-center">
                    <div class="flex items-center justify-center gap-2">
                        <button onclick="updateCartQuantity(${item.id}, ${item.quantity - 1})"
                                class="w-8 h-8 rounded-full border border-gray-200 hover:bg-gray-100 transition-colors duration-200">
                            <i class="fas fa-minus text-sm"></i>
                        </button>
                        <span class="font-semibold w-8 text-center" id="qty-${item.id}">${item.quantity}</span>
                        <button onclick="updateCartQuantity(${item.id}, ${item.quantity + 1})"
                                class="w-8 h-8 rounded-full border border-gray-200 hover:bg-gray-100 transition-colors duration-200">
                            <i class="fas fa-plus text-sm"></i>
                        </button>
                    </div>
                </td>
                <td class="px-4 py-4 text-right">
                    <span class="text-sm text-gray-600">$${item.price}</span>
                </td>
                <td class="px-4 py-4 text-right">
                    <span class="font-semibold text-primary" id="item-total-${item.id}">$${itemTotal}</span>
                </td>
                <td class="px-4 py-4 text-center">
                    <button onclick="removeFromCart(${item.id})"
                            class="text-red-500 hover:text-red-700 transition-colors duration-200">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
        `;
    });

    itemsHtml += `
                    </tbody>
                </table>
            </div>
            <div class="px-4 py-3 border-t border-gray-200 flex justify-between">
                <a href="/hotels" class="text-primary hover:text-primary-dark font-medium flex items-center gap-1">
                    <i class="fas fa-arrow-left"></i> Continue Shopping
                </a>
                <button onclick="clearCart()" class="text-red-500 hover:text-red-700 font-medium text-sm">
                    <i class="fas fa-trash-alt mr-1"></i> Clear Cart
                </button>
            </div>
        </div>
    `;

    container.innerHTML = itemsHtml;

    // Order Summary
    if (summary) {
        summary.innerHTML = `
            <div class="bg-white rounded-xl shadow-soft p-6 sticky top-24">
                <h3 class="text-xl font-heading font-bold text-secondary mb-4">Order Summary</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Subtotal</span>
                        <span class="font-semibold">Rs.${subtotal}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Delivery Fee</span>
                        <span class="font-semibold">Rs.${deliveryFee}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Service Charge (10%)</span>
                        <span class="font-semibold">Rs.${serviceCharge}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Tax (13%)</span>
                        <span class="font-semibold">Rs.${tax}</span>
                    </div>
                    <div class="border-t border-gray-200 pt-3">
                        <div class="flex justify-between">
                            <span class="text-lg font-heading font-bold text-secondary">Total</span>
                            <span class="text-2xl font-heading font-bold text-primary">Rs.${total}</span>
                        </div>
                    </div>
                </div>
                <a href="${checkoutUrl}" class="btn-primary w-full text-center py-3 mt-4 flex items-center justify-center gap-2">
                    <i class="fas fa-lock"></i> Proceed to Checkout
                </a>
                <p class="text-xs text-gray-400 text-center mt-3">
                    <i class="fas fa-shield-alt mr-1"></i> Secure checkout
                </p>
            </div>
        `;
    }

    updateCartBadge();
}

// ============================================
// NOTIFICATION
// ============================================
function showNotification(message, type = 'success') {
    const colors = {
        success: 'bg-green-500',
        error: 'bg-red-500',
        warning: 'bg-yellow-500',
        info: 'bg-blue-500'
    };

    const icons = {
        success: 'fa-check-circle',
        error: 'fa-exclamation-circle',
        warning: 'fa-exclamation-triangle',
        info: 'fa-info-circle'
    };

    const existing = document.querySelector('.cart-notification');
    if (existing) existing.remove();

    const notification = document.createElement('div');
    notification.className = `cart-notification fixed top-20 right-4 z-50 ${colors[type] || 'bg-green-500'} text-white px-6 py-3 rounded-lg shadow-lg transform transition-all duration-500 translate-x-full max-w-sm`;
    notification.innerHTML = `
        <div class="flex items-center gap-3">
            <i class="fas ${icons[type] || 'fa-check-circle'} text-xl"></i>
            <p class="text-sm">${message}</p>
        </div>
    `;
    document.body.appendChild(notification);

    setTimeout(() => notification.classList.remove('translate-x-full'), 100);
    setTimeout(() => {
        notification.classList.add('translate-x-full');
        setTimeout(() => notification.remove(), 500);
    }, 3000);
}

// ============================================
// EXPOSE ALL FUNCTIONS GLOBALLY
// ============================================
window.addToCart = addToCart;
window.updateCartBadge = updateCartBadge;
window.getCart = getCart;
window.removeFromCart = removeFromCart;
window.updateCartQuantity = updateCartQuantity;
window.clearCart = clearCart;
window.renderCart = renderCart;

// ============================================
// LOAD ON PAGE LOAD
// ============================================
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOMContentLoaded: updating badge');
    updateCartBadge();
    if (document.getElementById('cart-container')) {
        renderCart();
    }
});

// ============================================
// HANDLE BACK/FORWARD NAVIGATION (bfcache)
// Fires on every page show, including restores
// ============================================
window.addEventListener('pageshow', function(event) {
    console.log('pageshow fired, persisted:', event.persisted);
    updateCartBadge();
    if (document.getElementById('cart-container')) {
        renderCart();
    }
});

// ============================================
// HANDLE TAB VISIBILITY (user switches back to tab)
// ============================================
document.addEventListener('visibilitychange', function() {
    if (document.visibilityState === 'visible') {
        console.log('Tab visible: updating badge');
        updateCartBadge();
        if (document.getElementById('cart-container')) {
            renderCart();
        }
    }
});

// ============================================
// SYNC ACROSS TABS
// ============================================
window.addEventListener('storage', function(e) {
    if (e.key === 'cart') {
        console.log('Cart changed in another tab');
        updateCartBadge();
        if (document.getElementById('cart-container')) {
            renderCart();
        }
    }
});
