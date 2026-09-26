<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>

<!-- ============================================ -->
<!-- HOTEL HEADER -->
<!-- ============================================ -->
<section class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">

            <!-- Hotel Info -->
            <div class="flex items-center gap-4">
                <img src="{{ $hotel->logo ? asset('storage/' . $hotel->logo) : 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=100&h=100&fit=crop' }}"
                     alt="{{ $hotel->company_name }}"
                     class="w-16 h-16 md:w-20 md:h-20 rounded-xl object-cover border border-gray-200">
                <div>
                    <h1 class="text-2xl md:text-3xl font-heading font-bold text-secondary">{{ $hotel->company_name }}</h1>
                    <div class="flex flex-wrap items-center gap-3 mt-1">
                        <span class="flex items-center gap-1 text-sm text-gray-500">
                            <i class="fas fa-map-marker-alt text-primary"></i>
                            {{ $hotel->address ?? 'Nepal' }}
                        </span>
                        <span class="text-gray-300">|</span>
                        <span class="flex items-center gap-1 text-sm">
                            <span class="text-yellow-500">★★★★★</span>
                            <span class="font-semibold text-gray-700">4.8</span>
                            <span class="text-gray-400">(245 reviews)</span>
                        </span>
                        <span class="text-gray-300">|</span>
                        <span class="bg-green-500 text-white text-xs px-2.5 py-0.5 rounded-full font-medium">Open Now</span>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex gap-3 w-full md:w-auto">
                <a href="#" class="btn-primary flex-1 md:flex-none text-center flex items-center justify-center gap-2">
                    <i class="fas fa-shopping-cart"></i> Order Now
                </a>
                <button class="border-2 border-primary text-primary hover:bg-primary hover:text-white px-4 py-2.5 rounded-lg transition-all duration-200">
                    <i class="far fa-heart"></i>
                </button>
            </div>
        </div>
    </div>
</section>

<!-- ============================================ -->
<!-- MENU CONTENT -->
<!-- ============================================ -->
<section class="py-8 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

            <!-- ========================================== -->
            <!-- SIDEBAR - Categories -->
            <!-- ========================================== -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-soft p-4 sticky top-24">
                    <h3 class="font-heading font-semibold text-secondary mb-3 flex items-center gap-2">
                        <i class="fas fa-list text-primary"></i>
                        Categories
                    </h3>
                    <ul class="space-y-1" id="category-list">
                        @forelse($categories as $category)
                            <li>
                                <a href="#category-{{ $category->id }}"
                                   class="flex items-center justify-between px-3 py-2 rounded-lg hover:bg-gray-50 text-gray-700 transition-all duration-200 category-link {{ $loop->first ? 'bg-primary/10 text-primary font-medium' : '' }}">
                                    <span><i class="fas fa-utensil-spoon mr-2"></i> {{ $category->name }}</span>
                                    <span class="text-xs bg-gray-200 text-gray-600 px-2 py-0.5 rounded-full">{{ $category->menu_items_count ?? 0 }}</span>
                                </a>
                            </li>
                        @empty
                            <li class="text-center text-gray-500 py-4">No categories available</li>
                        @endforelse
                    </ul>
                </div>
            </div>

            <!-- ========================================== -->
            <!-- MENU ITEMS -->
            <!-- ========================================== -->
            <div class="lg:col-span-3">

                @forelse($categories as $category)
                <!-- ========================================== -->
                <!-- CATEGORY: {{ $category->name }} -->
                <!-- ========================================== -->
                <div id="category-{{ $category->id }}" class="mb-8 scroll-mt-24">
                    <div class="flex items-center gap-3 mb-4">
                        <h2 class="text-2xl font-heading font-bold text-secondary">{{ $category->name }}</h2>
                        <span class="text-sm text-gray-400">{{ $category->menuItems->count() }} items</span>
                        <div class="flex-1 h-px bg-gray-200"></div>
                    </div>

                    <div class="space-y-4">
                        @forelse($category->menuItems->where('status', 'enable') as $item)
                        <!-- Menu Item -->
                        <div class="bg-white rounded-xl shadow-soft p-4 hover:shadow-medium transition-all duration-200 group {{ $item->dicount > 0 ? 'border-2 border-primary/20' : '' }}">
                            <div class="flex flex-col sm:flex-row gap-4">
                                <!-- Item Image -->
                                <div class="relative">
                                    <img src="{{ $item->image ? asset('storage/' . $item->image) : 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=150&h=150&fit=crop' }}"
                                         alt="{{ $item->tittle }}"
                                         class="w-full sm:w-32 h-32 rounded-lg object-cover">
                                    @if($item->dicount > 0)
                                        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs px-2 py-0.5 rounded-full font-bold">
                                            -{{ round(($item->dicount / $item->price) * 100) }}%
                                        </span>
                                    @endif
                                </div>

                                <div class="flex-1">
                                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
                                        <div>
                                            <h3 class="font-heading font-semibold text-secondary text-lg">{{ $item->tittle }}</h3>
                                            <p class="text-sm text-gray-500 mt-1">{{ Str::limit($item->description, 100) }}</p>
                                            <div class="flex flex-wrap gap-1 mt-2">
                                                <span class="text-xs bg-gray-100 text-gray-600 px-2 py-0.5 rounded-full">⏱️ 15 min</span>
                                                @if($loop->first && $category->menuItems->where('status', 'enable')->count() > 0)
                                                    <span class="text-xs bg-red-100 text-red-700 px-2 py-0.5 rounded-full">🔥 Popular</span>
                                                @endif
                                            </div>
                                        </div>
                                        {{-- resources/views/Frontend/pages/hotel-menu.blade.php --}}

<div class="flex items-center justify-between mt-3 pt-3 border-t border-gray-100 gap-3">
    <span class="text-lg font-bold text-primary">
        @if($item->dicount > 0)
            <span class="text-sm text-gray-400 line-through">Rs.{{ number_format($item->price, 2) }}</span>
            <span class="text-lg font-bold text-primary ml-1">Rs.{{ number_format($item->price - $item->dicount, 2) }}</span>
        @else
            Rs.{{ number_format($item->price ) }}
        @endif
    </span>
   @auth
    <button
    onclick="addToCart(
        {{ $item->id }},
        @js($item->tittle),
        {{ $item->price - ($item->dicount ?? 0) }},
        @js($item->image ? asset('storage/' . $item->image) : ''),
        1
    )"
    class="btn-primary py-1.5 px-4 text-sm menu-add-to-cart">
    <i class="fas fa-plus mr-1"></i> Add
</button>
    @else
        <button class="btn-primary py-1.5 px-4 text-sm ">
        <a href="{{ route('login') }}"><i class="fas fa-plus mr-1"></i> Add</a>
    </button>
    @endauth
</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-8 bg-white rounded-xl shadow-soft">
                            <p class="text-gray-500">No items available in this category</p>
                        </div>
                        @endforelse
                    </div>
                </div>
                @empty
                <!-- No Categories -->
                <div class="text-center py-12">
                    <div class="text-6xl mb-4">🍽️</div>
                    <h3 class="text-2xl font-heading font-bold text-secondary mb-2">No Menu Available</h3>
                    <p class="text-gray-500">This hotel hasn't added any menu items yet.</p>
                </div>
                @endforelse

                <!-- ========================================== -->
                <!-- ORDER SUMMARY (Sticky Bottom - Mobile) -->
                <!-- ========================================== -->
                <div class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 shadow-lg p-4 z-50 md:hidden">
                    <div class="max-w-7xl mx-auto flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Cart Total</p>
                            <p class="text-2xl font-heading font-bold text-primary" id="mobile-cart-total">$0.00</p>
                        </div>
                        <a href="#" class="btn-primary py-3 px-8 flex items-center gap-2">
                            <i class="fas fa-shopping-cart"></i> View Cart (<span id="mobile-cart-count">0</span>)
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================ -->
<!-- DESKTOP ORDER BUTTON (Floating) -->
<!-- ============================================ -->
<div class="fixed bottom-6 right-6 hidden md:block z-40">
    <a href="#" class="btn-primary py-3 px-6 shadow-lg flex items-center gap-3 hover:scale-105 transition-all duration-200">
        <i class="fas fa-shopping-cart text-xl"></i>
        <div class="text-left">
            <p class="text-xs opacity-75">Your Order</p>
            <p class="font-bold" id="desktop-cart-total">$0.00</p>
        </div>
        <span class="bg-white/20 px-2 py-0.5 rounded-full text-xs font-bold" id="desktop-cart-count">0</span>
    </a>
</div>




    <!-- 2. Page Specific Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ============================================
            // SMOOTH SCROLL FOR CATEGORIES
            // ============================================
            document.querySelectorAll('.category-link').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                    document.querySelectorAll('.category-link').forEach(link => {
                        link.classList.remove('bg-primary/10', 'text-primary', 'font-medium');
                        link.classList.add('text-gray-700');
                    });
                    this.classList.add('bg-primary/10', 'text-primary', 'font-medium');
                    this.classList.remove('text-gray-700');
                });
            });

            // ============================================
            // ACTIVE CATEGORY HIGHLIGHT ON SCROLL
            // ============================================
            const categoryLinks = document.querySelectorAll('.category-link');
            const sections = document.querySelectorAll('.scroll-mt-24');

            window.addEventListener('scroll', () => {
                let current = '';
                sections.forEach(section => {
                    const sectionTop = section.offsetTop - 100;
                    if (window.scrollY >= sectionTop) {
                        current = section.getAttribute('id');
                    }
                });

                categoryLinks.forEach(link => {
                    link.classList.remove('bg-primary/10', 'text-primary', 'font-medium');
                    link.classList.add('text-gray-700');
                    if (link.getAttribute('href') === `#${current}`) {
                        link.classList.add('bg-primary/10', 'text-primary', 'font-medium');
                        link.classList.remove('text-gray-700');
                    }
                });
            });

            // ============================================
            // HOTEL MENU ADD TO CART
            // ============================================
            document.querySelectorAll('.menu-add-to-cart').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    const id = this.dataset.id;
                    const name = this.dataset.name;
                    const price = parseFloat(this.dataset.price);

                    if (typeof window.addToCart === 'function') {
                        window.addToCart(id, name, price);
                    } else {
                        console.error('addToCart not loaded!');
                    }

                    // Button feedback
                    const originalHTML = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-check mr-1"></i> Added';
                    this.classList.remove('btn-primary');
                    this.classList.add('bg-green-500', 'hover:bg-green-600');
                    setTimeout(() => {
                        this.innerHTML = originalHTML;
                        this.classList.remove('bg-green-500', 'hover:bg-green-600');
                        this.classList.add('btn-primary');
                    }, 1000);
                });
            });
        });
    </script>


</body>
</html>
