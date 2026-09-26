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

        <h1 class="text-3xl font-heading font-bold text-secondary mb-6">Checkout</h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- ============================================ -->
            <!-- LEFT SIDE: Shipping & Payment -->
            <!-- ============================================ -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Shipping Address Section -->
                <div class="bg-white rounded-xl shadow-soft p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-heading font-bold text-secondary flex items-center gap-2">
                            <i class="fas fa-map-marker-alt text-primary"></i>
                            Shipping Address
                        </h2>
                        <button onclick="openAddressModal()"
                                class="text-primary hover:text-primary-dark font-medium text-sm flex items-center gap-1">
                            <i class="fas fa-plus"></i> Add New
                        </button>
                    </div>

                    <!-- Address List -->
                    <div id="address-list" class="space-y-3">
                        @forelse($addresses as $address)
                        <label class="flex items-start gap-3 p-4 border-2 rounded-xl cursor-pointer transition-all duration-200 address-item {{ $address->is_default ? 'border-primary bg-primary/5' : 'border-gray-200 hover:border-primary/50' }}"
                               data-id="{{ $address->id }}">
                            <input type="radio"
                                   name="shipping_address_id"
                                   value="{{ $address->id }}"
                                   class="mt-1 text-primary focus:ring-primary address-radio"
                                   {{ $address->is_default ? 'checked' : '' }}>
                            <div class="flex-1">
                                <div class="flex items-center gap-2">
                                    <p class="font-semibold text-gray-800">{{ $address->tittle }}</p>
                                    @if($address->is_default)
                                        <span class="text-xs bg-primary text-white px-2 py-0.5 rounded-full">Default</span>
                                    @endif
                                </div>
                                <p class="text-sm text-gray-500 mt-1">
                                    <i class="fas fa-phone text-primary w-4"></i> {{ $address->contact_no }}
                                </p>
                                <p class="text-sm text-gray-500 mt-1">
                                    <i class="fas fa-home text-primary w-4"></i> {{ $address->full_address }}
                                </p>
                            </div>
                            <div class="flex flex-col gap-2">
                                <button type="button" onclick="editAddress({{ $address->id }})"
                                        class="text-blue-500 hover:text-blue-700 p-1.5 hover:bg-blue-50 rounded-lg">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" onclick="deleteAddress({{ $address->id }})"
                                        class="text-red-500 hover:text-red-700 p-1.5 hover:bg-red-50 rounded-lg">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </label>
                        @empty
                        <div class="text-center py-8 bg-gray-50 rounded-xl">
                            <div class="text-4xl mb-2">📍</div>
                            <p class="text-gray-500 mb-3">No shipping address added yet</p>
                            <button onclick="openAddressModal()" class="btn-primary py-2 px-6 text-sm">
                                <i class="fas fa-plus mr-1"></i> Add Address
                            </button>
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- Payment Method Section -->
                <div class="bg-white rounded-xl shadow-soft p-6">
                    <h2 class="text-xl font-heading font-bold text-secondary flex items-center gap-2 mb-4">
                        <i class="fas fa-credit-card text-primary"></i>
                        Payment Method
                    </h2>

                    <div class="space-y-3">
                        <!-- Cash on Delivery -->
                        <label class="flex items-start gap-3 p-4 border-2 rounded-xl cursor-pointer transition-all duration-200 payment-item border-primary bg-primary/5"
                               data-method="cod">
                            <input type="radio"
                                   name="payment_method"
                                   value="cod"
                                   class="mt-1 text-primary focus:ring-primary payment-radio"
                                   checked>
                            <div class="flex-1">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-money-bill-wave text-green-500 text-lg"></i>
                                    <p class="font-semibold text-gray-800">Cash on Delivery</p>
                                </div>
                                <p class="text-sm text-gray-500 mt-1">Pay when your order is delivered</p>
                            </div>
                        </label>

                        <!-- Online Payment -->
                        <label class="flex items-start gap-3 p-4 border-2 rounded-xl cursor-pointer transition-all duration-200 payment-item border-gray-200 hover:border-primary/50"
                               data-method="online">
                            <input type="radio"
                                   name="payment_method"
                                   value="online"
                                   class="mt-1 text-primary focus:ring-primary payment-radio">
                            <div class="flex-1">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-credit-card text-blue-500 text-lg"></i>
                                    <p class="font-semibold text-gray-800">Online Payment</p>
                                    <span class="text-xs bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full">Recommended</span>
                                </div>
                                <p class="text-sm text-gray-500 mt-1">Pay securely with card, mobile banking, or wallet</p>
                                <div class="flex gap-2 mt-2">
                                    <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">Visa</span>
                                    <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">Mastercard</span>
                                    <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">eSewa</span>
                                    <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">Khalti</span>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

            </div>

            <!-- ============================================ -->
            <!-- RIGHT SIDE: Order Summary -->
            <!-- ============================================ -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-soft p-6 sticky top-24">
                    <h3 class="text-xl font-heading font-bold text-secondary mb-4">Order Summary</h3>

                    <!-- Cart Items (loaded by JS) -->
                    <div id="checkout-items" class="space-y-3 max-h-64 overflow-y-auto mb-4">
                        <!-- Items loaded by JS -->
                    </div>

                    <div class="space-y-3 border-t border-gray-200 pt-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="font-semibold" id="checkout-subtotal">Rs.0.00</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Delivery Fee</span>
                            <span class="font-semibold">Rs.3.00</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Service Charge (10%)</span>
                            <span class="font-semibold" id="checkout-service">Rs.0.00</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tax (13%)</span>
                            <span class="font-semibold" id="checkout-tax">Rs.0.00</span>
                        </div>

                        <div class="border-t border-gray-200 pt-3">
                            <div class="flex justify-between">
                                <span class="text-lg font-heading font-bold text-secondary">Total</span>
                                <span class="text-2xl font-heading font-bold text-primary" id="checkout-total">Rs.0.00</span>
                            </div>
                        </div>
                    </div>

                    <button onclick="placeOrder()"
                            id="place-order-btn"
                            class="btn-primary w-full text-center py-3 mt-4 flex items-center justify-center gap-2">
                        <i class="fas fa-lock"></i> Place Order
                    </button>

                    <p class="text-xs text-gray-400 text-center mt-3">
                        <i class="fas fa-shield-alt mr-1"></i> Secure checkout
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================ -->
<!-- ADDRESS MODAL -->
<!-- ============================================ -->
<div id="addressModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm">
    <div class="bg-white rounded-2xl p-6 max-w-md w-full mx-4 shadow-2xl">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-heading font-bold text-secondary" id="modal-title">Add Shipping Address</h3>
            <button onclick="closeAddressModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <form id="address-form" onsubmit="saveAddress(event)">
            @csrf
            <input type="hidden" id="address-id" name="address_id">

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">
                        Address Title <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           id="address-tittle"
                           name="tittle"
                           class="input-primary"
                           placeholder="e.g., Home, Office"
                           required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">
                        Contact Number <span class="text-red-500">*</span>
                    </label>
                    <input type="tel"
                           id="address-contact"
                           name="contact_no"
                           class="input-primary"
                           placeholder="+977 9800000000"
                           required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">
                        Full Address <span class="text-red-500">*</span>
                    </label>
                    <textarea id="address-full"
                              name="full_address"
                              rows="3"
                              class="input-primary"
                              placeholder="House no., street, area, city"
                              required></textarea>
                </div>

                <div class="flex items-center gap-2">
                    <input type="checkbox"
                           id="address-default"
                           name="is_default"
                           class="rounded border-gray-300 text-primary focus:ring-primary">
                    <label for="address-default" class="text-sm text-gray-600">
                        Set as default address
                    </label>
                </div>
            </div>

            <div class="flex gap-3 mt-6">
                <button type="button" onclick="closeAddressModal()" class="btn-outline flex-1 py-2.5">
                    Cancel
                </button>
                <button type="submit" class="btn-primary flex-1 py-2.5">
                    <i class="fas fa-save mr-1"></i> Save Address
                </button>
            </div>
        </form>
    </div>
</div>

</body>
</html>

<script>
    // ============================================
    // LOAD CART ITEMS
    // ============================================
    function loadCheckoutItems() {
        const cart = JSON.parse(localStorage.getItem('cart') || '[]');
        const container = document.getElementById('checkout-items');

        if (cart.length === 0) {
            container.innerHTML = '<p class="text-gray-500 text-center py-4">Your cart is empty</p>';
            return;
        }

        let html = '';
        let subtotal = 0;

        cart.forEach(item => {
            const itemTotal = item.price * item.quantity;
            subtotal += itemTotal;

            html += `
                <div class="flex items-center gap-3 py-2">
                    <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center text-primary font-bold">
                        ${item.quantity}x
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-gray-800 text-sm">${item.name}</p>
                        <p class="text-xs text-gray-500">Rs.${item.price} each</p>
                    </div>
                    <span class="font-semibold text-gray-700 text-sm">Rs.${itemTotal}</span>
                </div>
            `;
        });

        container.innerHTML = html;

        // Calculate totals
        const deliveryFee = 3.00;
        const serviceCharge = subtotal * 0.10;
        const tax = (subtotal + deliveryFee + serviceCharge) * 0.13;
        const total = subtotal + deliveryFee + serviceCharge + tax;

        document.getElementById('checkout-subtotal').textContent = 'Rs.' + subtotal.toFixed(2);
        document.getElementById('checkout-service').textContent = 'Rs.' + serviceCharge.toFixed(2);
        document.getElementById('checkout-tax').textContent = 'Rs.' + tax.toFixed(2);
        document.getElementById('checkout-total').textContent = 'Rs.' + total.toFixed(2);
    }

    // ============================================
    // ADDRESS MODAL
    // ============================================
    function openAddressModal() {
        document.getElementById('modal-title').textContent = 'Add Shipping Address';
        document.getElementById('address-form').reset();
        document.getElementById('address-id').value = '';
        document.getElementById('addressModal').classList.remove('hidden');
        document.getElementById('addressModal').classList.add('flex');
    }

    function closeAddressModal() {
        document.getElementById('addressModal').classList.add('hidden');
        document.getElementById('addressModal').classList.remove('flex');
    }

    // ============================================
    // SAVE ADDRESS
    // ============================================
    function saveAddress(e) {
        e.preventDefault();

        const addressId = document.getElementById('address-id').value;
        const url = addressId
            ? `/checkout/address/${addressId}`
            : '/checkout/address';

        const formData = {
            tittle: document.getElementById('address-tittle').value,
            contact_no: document.getElementById('address-contact').value,
            full_address: document.getElementById('address-full').value,
            is_default: document.getElementById('address-default').checked,
            _token: '{{ csrf_token() }}'
        };

        fetch(url, {
            method: addressId ? 'PUT' : 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                closeAddressModal();
                location.reload(); // Reload to show new address
            } else {
                alert(data.message || 'Error saving address');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Something went wrong!');
        });
    }

    // ============================================
    // EDIT ADDRESS
    // ============================================
    function editAddress(id) {
        fetch(`/checkout/address/${id}`)
            .then(response => response.json())
            .then(data => {
                if (data.address) {
                    document.getElementById('modal-title').textContent = 'Edit Shipping Address';
                    document.getElementById('address-id').value = data.address.id;
                    document.getElementById('address-tittle').value = data.address.tittle;
                    document.getElementById('address-contact').value = data.address.contact_no;
                    document.getElementById('address-full').value = data.address.full_address;
                    document.getElementById('address-default').checked = data.address.is_default;

                    document.getElementById('addressModal').classList.remove('hidden');
                    document.getElementById('addressModal').classList.add('flex');
                }
            });
    }

    // ============================================
    // DELETE ADDRESS
    // ============================================
    function deleteAddress(id) {
        if (!confirm('Are you sure you want to delete this address?')) return;

        fetch(`/checkout/address/${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        });
    }

    // ============================================
    // PAYMENT METHOD SELECTION
    // ============================================
    document.querySelectorAll('.payment-radio').forEach(radio => {
        radio.addEventListener('change', function() {
            document.querySelectorAll('.payment-item').forEach(item => {
                item.classList.remove('border-primary', 'bg-primary/5');
                item.classList.add('border-gray-200');
            });
            this.closest('.payment-item').classList.remove('border-gray-200');
            this.closest('.payment-item').classList.add('border-primary', 'bg-primary/5');
        });
    });

    // ============================================
    // ADDRESS SELECTION
    // ============================================
    document.querySelectorAll('.address-radio').forEach(radio => {
        radio.addEventListener('change', function() {
            document.querySelectorAll('.address-item').forEach(item => {
                item.classList.remove('border-primary', 'bg-primary/5');
                item.classList.add('border-gray-200');
            });
            this.closest('.address-item').classList.remove('border-gray-200');
            this.closest('.address-item').classList.add('border-primary', 'bg-primary/5');
        });
    });


function placeOrder() {
    const addressSelected = document.querySelector('.address-radio:checked');
    if (!addressSelected) {
        alert('Please select a shipping address');
        return;
    }

    const paymentSelected = document.querySelector('.payment-radio:checked');
    if (!paymentSelected) {
        alert('Please select a payment method');
        return;
    }

    const cart = JSON.parse(localStorage.getItem('cart') || '[]');
    if (cart.length === 0) {
        alert('Your cart is empty');
        return;
    }

    const btn = document.getElementById('place-order-btn');
    const originalText = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Processing...';

    fetch('/checkout/place-order', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            shipping_address_id: addressSelected.value,
            payment_method: paymentSelected.value,
            cart_data: JSON.stringify(cart)
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            localStorage.removeItem('cart');
            window.location.href = data.redirect;
        } else {
            alert(data.message || 'Error placing order');
            btn.disabled = false;
            btn.innerHTML = originalText;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Something went wrong!');
        btn.disabled = false;
        btn.innerHTML = originalText;
    });
}
    // ============================================
    // LOAD ON PAGE READY
    // ============================================
    document.addEventListener('DOMContentLoaded', function() {
        loadCheckoutItems();
    });
</script>

