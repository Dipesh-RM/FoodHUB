<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>

    {{-- resources/views/Frontend/pages/home.blade.php --}}


    <!-- ============================================ -->
    <!-- HERO SECTION WITH SEARCH -->
    <!-- ============================================ -->
    <nav class="sticky top-0 z-50 bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 md:h-20">

                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center space-x-2 group">
                    <div
                        class="w-10 h-10 bg-gradient-primary rounded-lg flex items-center justify-center text-white font-bold text-xl">
                        <span>ख</span>
                    </div>
                    <div>
                        <span class="text-2xl font-heading font-bold text-primary">Chakhajza</span>
                        <span
                            class="block text-[10px] text-gray-400 -mt-0.5 font-medium tracking-wider uppercase">Discover
                            Local Food</span>
                    </div>
                </a>

                <!-- Right Section -->
                <div class="flex items-center space-x-2 md:space-x-4">

                    <!-- Cart -->
                    <a href="" class="relative text-gray-700 hover:text-primary p-2">
                        <i class="fas fa-shopping-bag text-xl"></i>
                        <span
                            class="absolute -top-0.5 -right-0.5 bg-primary text-white text-[10px] font-bold w-5 h-5 rounded-full flex items-center justify-center shadow-lg cart-badge">
                            0
                        </span>
                    </a>

                    <!-- User Section -->
                    @auth
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" @click.away="open = false"
                                class="flex items-center space-x-2 focus:outline-none group">
                                <div
                                    class="w-8 h-8 md:w-9 md:h-9 rounded-full bg-gradient-primary text-white flex items-center justify-center font-bold text-sm shadow-md group-hover:shadow-lg transition-all duration-200 cursor-pointer hover:scale-105">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <span
                                    class="text-sm font-medium text-gray-700 hidden md:inline-block">{{ auth()->user()->name }}</span>
                                <i
                                    class="fas fa-chevron-down text-gray-400 text-xs group-hover:text-primary transition-colors duration-200"></i>
                            </button>

                            <!-- Dropdown -->
                            <div x-show="open" x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                                class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-xl border border-gray-100 py-1.5 z-50">

                                <div class="px-4 py-3 border-b border-gray-100">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 rounded-full bg-gradient-primary text-white flex items-center justify-center font-bold text-sm">
                                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-800 text-sm truncate">
                                                {{ auth()->user()->name }}</p>
                                            <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                                        </div>
                                    </div>

                                    <!-- Show Vendor Badge if user has vendor account -->

                                </div>

                                <!-- Links for Everyone -->
                                <a href=""
                                    class="flex items-center px-4 py-2.5 text-sm hover:bg-gray-50 text-gray-700 transition-colors duration-200">
                                    <i class="fas fa-user w-4 h-4 mr-3 text-gray-400"></i> My Profile
                                </a>
                                <a href=""
                                    class="flex items-center px-4 py-2.5 text-sm hover:bg-gray-50 text-gray-700 transition-colors duration-200">
                                    <i class="fas fa-shopping-bag w-4 h-4 mr-3 text-gray-400"></i> My Orders
                                </a>
                                <a href=""
                                    class="flex items-center px-4 py-2.5 text-sm hover:bg-gray-50 text-gray-700 transition-colors duration-200">
                                    <i class="fas fa-heart w-4 h-4 mr-3 text-gray-400"></i> Favorites
                                </a>

                                <!-- Vendor Links (Only if user has approved vendor account) -->


                                <!-- Logout -->
                                <div class="border-t border-gray-100 mt-1 pt-1">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="flex items-center w-full px-4 py-2.5 text-sm hover:bg-red-50 text-red-600 transition-colors duration-200">
                                            <i class="fas fa-sign-out-alt w-4 h-4 mr-3"></i> Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @if (\App\Models\Vendors::where('email', auth()->user()->email)->exists())
                            <!-- Vendor Dashboard --> <a href="http://127.0.0.1:8000/vendor"
                                class="btn-primary bg-gray-500 hover:bg-amber-500 py-2 px-4 text-sm flex items-center gap-1">
                                <i class="fa-solid fa-bars"></i>Dashboard </a>
                        @else
                            <!-- Hotel Register --> <a href="{{ route('register') }}"
                                class="btn-primary py-2 px-4 text-sm flex items-center gap-1.5"> <i
                                    class="fas fa-user-plus"></i> Hotel Register </a>
                        @endif
                    @else
                        <!-- Login & Register -->
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('redirect') }}"
                                class="text-gray-700 hover:text-primary font-medium px-3 py-2 rounded-lg text-sm transition-colors duration-200 hover:bg-primary/5">
                                <i class="fas fa-sign-in-alt mr-1.5"></i> Login
                            </a>
                            <a href="{{ route('register') }}"
                                class="btn-primary py-2 px-4 text-sm flex  items-center gap-1.5">
                                <i class="fas fa-user-plus"></i>Hotel Register
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="hero-gradient absolute inset-0 opacity-90"></div>
    {{-- <div class="absolute inset-0 bg-[url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTGvZT_kopqGLp2jsRcnLDKs9fac5r9aoh0SYN4WVfDUw&s=10')] bg-repeat opacity-100"></div> --}}
    <div class="absolute inset-0 bg-purple-400 bg-repeat opacity-100"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24 lg:py-32">
        <div class="max-w-4xl mx-auto text-center text-white animate-fade-in">

            <!-- Badge -->
            <span class="inline-block bg-white/20 backdrop-blur-sm px-4 py-1.5 rounded-full text-sm font-medium mb-4">
                🍽️ Discover Local Flavors
            </span>

            <h1 class="text-4xl md:text-5xl lg:text-6xl font-heading font-bold leading-tight mb-4">
                Find Amazing Food <br>
                <span class="text-yellow-300">Near Your Location</span>
            </h1>
            <p class="text-lg md:text-xl text-white/90 mb-8 max-w-2xl mx-auto">
                Discover and order delicious food from nearby hotels. Search by food, hotel, or location.
            </p>

            <!-- ============================================ -->
            <!-- MAIN SEARCH FORM -->
            <!-- ============================================ -->
            <form action="{{ route('search') }}" method="GET" class="relative max-w-3xl mx-auto">
                <div class="bg-white rounded-2xl shadow-2xl p-2 md:p-3">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-2">

                        <!-- Search Input -->
                        <div class="md:col-span-5 relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" name="q" id="search-input" value="{{ request('q') }}"
                                placeholder="Search food, hotels, or cuisine..."
                                class="w-full pl-11 pr-4 py-3 md:py-3.5 rounded-xl border-0 focus:ring-2 focus:ring-primary/30 outline-none text-gray-800 placeholder-gray-400 bg-gray-50/50">
                        </div>

                        <!-- Location Input -->
                        <div class="md:col-span-4 relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <i class="fas fa-map-marker-alt"></i>
                            </span>
                            <input type="text" name="location" id="location-input" value="{{ request('location') }}"
                                placeholder="Enter city or location..."
                                class="w-full pl-11 pr-4 py-3 md:py-3.5 rounded-xl border-0 focus:ring-2 focus:ring-primary/30 outline-none text-gray-800 placeholder-gray-400 bg-gray-50/50">
                        </div>

                        <!-- Search Button -->
                        <div class="md:col-span-3 bg-blue-500 rounded-2xl">
                            <button type="submit"
                                class="btn-primary w-full py-3 md:py-3.5 text-base flex items-center justify-center gap-2">
                                <i class="fas fa-search"></i> Search
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Popular Searches -->
            <div class="mt-6 flex flex-wrap justify-center gap-2">
                <span class="text-white/80 text-sm">Popular:</span>
                <a href="{{ route('search', ['q' => 'Pizza']) }}"
                    class="bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white px-3 py-1 rounded-full text-sm transition-all duration-200">
                    🍕 Pizza
                </a>
                <a href="{{ route('search', ['q' => 'Burger']) }}"
                    class="bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white px-3 py-1 rounded-full text-sm transition-all duration-200">
                    🍔 Burger
                </a>
                <a href="{{ route('search', ['q' => 'Momo']) }}"
                    class="bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white px-3 py-1 rounded-full text-sm transition-all duration-200">
                    🥟 Momo
                </a>
                <a href="{{ route('search', ['q' => 'Dal Bhat']) }}"
                    class="bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white px-3 py-1 rounded-full text-sm transition-all duration-200">
                    🍛 Dal Bhat
                </a>
                <a href="{{ route('search', ['q' => 'Coffee']) }}"
                    class="bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white px-3 py-1 rounded-full text-sm transition-all duration-200">
                    ☕ Coffee
                </a>
                <a href="{{ route('search', ['location' => 'Kathmandu']) }}"
                    class="bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white px-3 py-1 rounded-full text-sm transition-all duration-200">
                    📍 Kathmandu
                </a>
                <a href="{{ route('search', ['location' => 'Pokhara']) }}"
                    class="bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white px-3 py-1 rounded-full text-sm transition-all duration-200">
                    📍 Pokhara
                </a>
            </div>
        </div>
    </div>

    <!-- Wave Divider -->
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M0 120L60 110C120 100 240 80 360 70C480 60 600 60 720 65C840 70 960 80 1080 85C1200 90 1320 90 1380 90L1440 90V120H0Z"
                fill="#F9FAFB" />
        </svg>
    </div>
    </section>

    <!-- ============================================ -->
    <!-- CATEGORIES SECTION -->
    <!-- ============================================ -->
    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <span class="bg-primary/10 text-primary font-medium px-3 py-1 rounded-full text-sm">Categories</span>
                <h2 class="text-3xl md:text-4xl font-heading font-bold text-secondary mb-3">Explore Food Categories
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Discover your favorite cuisine from local hotels</p>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @php
                    $categories = [
                        ['name' => 'Nepali', 'icon' => '🇳🇵', 'color' => 'bg-red-100'],
                        ['name' => 'Indian', 'icon' => '🇮🇳', 'color' => 'bg-orange-100'],
                        ['name' => 'Chinese', 'icon' => '🥢', 'color' => 'bg-red-100'],
                        ['name' => 'Italian', 'icon' => '🍕', 'color' => 'bg-green-100'],
                        ['name' => 'Continental', 'icon' => '🍖', 'color' => 'bg-blue-100'],
                        ['name' => 'Breakfast', 'icon' => '🍳', 'color' => 'bg-yellow-100'],
                    ];
                @endphp

                @foreach ($categories as $cat)
                    <a href="{{ route('search', ['cuisine' => $cat['name']]) }}"
                        class="bg-white rounded-xl p-4 text-center shadow-soft hover:shadow-medium hover:-translate-y-1 transition-all duration-300 group">
                        <div
                            class="w-16 h-16 mx-auto {{ $cat['color'] }} rounded-full flex items-center justify-center text-3xl group-hover:scale-110 transition-transform duration-300">
                            {{ $cat['icon'] }}
                        </div>
                        <p class="text-sm font-medium text-gray-700 mt-2">{{ $cat['name'] }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ============================================ -->
    <!-- FEATURED HOTELS SECTION -->
    <!-- ============================================ -->
    <section class="py-12 md:py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
                <div>
                    <span class="bg-primary/10 text-primary font-medium px-3 py-1 rounded-full text-sm">Hotels</span>
                    <h2 class="text-3xl md:text-4xl font-heading font-bold text-secondary mb-1">Featured Hotels</h2>
                    <p class="text-gray-600">Discover top-rated hotels near you</p>
                </div>
                <a href="{{ route('hotels.index') }}"
                    class="text-primary hover:text-primary-dark font-medium flex items-center gap-1 mt-2 sm:mt-0">
                    View All <i class="fas fa-arrow-right text-sm"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($featuredHotels as $hotel)
                    <div
                        class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 group">
                        <div class="relative">
                            <img src="{{ $hotel->logo ? asset('storage/' . $hotel->logo) : 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=400&h=250&fit=crop' }}"
                                alt="{{ $hotel->company_name }}"
                                class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute top-3 left-3">
                                <span
                                    class="bg-primary text-white text-xs px-2.5 py-1 rounded-full font-medium">Featured</span>
                            </div>
                            <div
                                class="absolute bottom-3 right-3 bg-white/90 backdrop-blur-sm px-2.5 py-1 rounded-lg flex items-center gap-1">
                                <span class="text-yellow-500">★</span>
                                <span class="text-sm font-semibold text-gray-800">4.8</span>
                                <span class="text-xs text-gray-500">(245)</span>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-heading font-semibold text-lg text-secondary">{{ $hotel->company_name }}
                            </h3>
                            <p class="text-gray-500 text-sm"><i class="fas fa-map-marker-alt text-primary w-4"></i>
                                {{ $hotel->city ?? 'Nepal' }}</p>
                            <div class="flex flex-wrap gap-1 mt-2">
                                @php
                                    $menuItems = $hotel->menuItems->take(3);
                                @endphp
                                @foreach ($menuItems as $item)
                                    <span
                                        class="text-xs bg-gray-100 text-gray-600 px-2 py-0.5 rounded-full">{{ $item->tittle }}</span>
                                @endforeach
                                @if ($hotel->menuItems->count() > 3)
                                    <span
                                        class="text-xs bg-gray-100 text-gray-600 px-2 py-0.5 rounded-full">+{{ $hotel->menuItems->count() - 3 }}</span>
                                @endif
                            </div>
                            <div class="flex items-center justify-between mt-3 pt-3 border-t border-gray-100">
                                <span class="text-sm text-gray-500">Min. order: <span
                                        class="font-semibold text-gray-700">$10</span></span>
                                <a href="{{ route('hotels.menu', $hotel->id) }}"
                                    class="btn-primary py-2 px-4 text-sm">View Menu</a>
                            </div>
                        </div>
                    </div>
                @empty
                    @for ($i = 1; $i <= 4; $i++)
                        <div
                            class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 group">
                            <div class="relative">
                                <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=400&h=250&fit=crop"
                                    alt="Hotel"
                                    class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500">
                                <div class="absolute top-3 left-3">
                                    <span
                                        class="bg-primary text-white text-xs px-2.5 py-1 rounded-full font-medium">Featured</span>
                                </div>
                                <div
                                    class="absolute bottom-3 right-3 bg-white/90 backdrop-blur-sm px-2.5 py-1 rounded-lg flex items-center gap-1">
                                    <span class="text-yellow-500">★</span>
                                    <span class="text-sm font-semibold text-gray-800">4.8</span>
                                    <span class="text-xs text-gray-500">(245)</span>
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="font-heading font-semibold text-lg text-secondary">Grand Plaza Hotel</h3>
                                <p class="text-gray-500 text-sm"><i
                                        class="fas fa-map-marker-alt text-primary w-4"></i> Kathmandu, Nepal</p>
                                <div class="flex flex-wrap gap-1 mt-2">
                                    <span
                                        class="text-xs bg-gray-100 text-gray-600 px-2 py-0.5 rounded-full">Nepali</span>
                                    <span
                                        class="text-xs bg-gray-100 text-gray-600 px-2 py-0.5 rounded-full">Continental</span>
                                </div>
                                <div class="flex items-center justify-between mt-3 pt-3 border-t border-gray-100">
                                    <span class="text-sm text-gray-500">Min. order: <span
                                            class="font-semibold text-gray-700">$10</span></span>
                                    <a href="" class="btn-primary py-2 px-4 text-sm">View Menu</a>
                                </div>
                            </div>
                        </div>
                    @endfor
                @endforelse
            </div>
        </div>
    </section>

    <!-- ============================================ -->
    <!-- POPULAR FOOD ITEMS SECTION -->
    <!-- ============================================ -->
    <section class="py-12 md:py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
                <div>
                    <span class="bg-primary/10 text-primary font-medium px-3 py-1 rounded-full text-sm">Food</span>
                    <h2 class="text-3xl md:text-4xl font-heading font-bold text-secondary mb-1">Popular Menu Items</h2>
                    <p class="text-gray-600">Most ordered dishes from local hotels</p>
                </div>
                <a href="{{ route('food.search') }}"
                    class="text-primary hover:text-primary-dark font-medium flex items-center gap-1 mt-2 sm:mt-0">
                    View All <i class="fas fa-arrow-right text-sm"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($popularItems as $item)
                    <div
                        class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 group">
                        <div class="relative">
                            <img src="{{ $item->image ? asset('storage/' . $item->image) : 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=400&h=250&fit=crop' }}"
                                alt="{{ $item->tittle }}"
                                class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500">
                            @if ($item->dicount > 0)
                                <div class="absolute top-3 left-3">
                                    <span class="bg-red-500 text-white text-xs px-2.5 py-1 rounded-full font-medium">
                                        -{{ round(($item->dicount / $item->price) * 100) }}%
                                    </span>
                                </div>
                            @endif
                            <div
                                class="absolute bottom-3 right-3 bg-white/90 backdrop-blur-sm px-2.5 py-1 rounded-lg flex items-center gap-1">
                                <span class="text-yellow-500">★</span>
                                <span class="text-sm font-semibold text-gray-800">4.5</span>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-heading font-semibold text-lg text-secondary">{{ $item->tittle }}</h3>
                            <p class="text-sm text-gray-500 line-clamp-2">{{ Str::limit($item->description, 60) }}</p>
                            <p class="text-sm text-gray-500 mt-1">
                                <i class="fas fa-utensils text-primary"></i>
                                {{ $item->vendor->company_name ?? 'Unknown Hotel' }}
                            </p>
                            <div class="flex items-center justify-between mt-3 pt-3 border-t border-gray-100">
                                <div>
                                    @if ($item->dicount > 0)
                                        <span
                                            class="text-sm text-gray-400 line-through">${{ number_format($item->price, 2) }}</span>
                                        <span
                                            class="text-lg font-bold text-primary ml-2">${{ number_format($item->price - $item->dicount, 2) }}</span>
                                    @else
                                        <span
                                            class="text-lg font-bold text-primary">${{ number_format($item->price, 2) }}</span>
                                    @endif
                                </div>
                                <button class="btn-primary py-1.5 px-4 text-sm add-to-cart"
                                    data-id="{{ $item->id }}">
                                    <i class="fas fa-plus mr-1"></i> Add
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    @for ($i = 1; $i <= 4; $i++)
                        <div
                            class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 group">
                            <div class="relative">
                                <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=400&h=250&fit=crop"
                                    alt="Food"
                                    class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500">
                            </div>
                            <div class="p-4">
                                <h3 class="font-heading font-semibold text-lg text-secondary">Classic Burger</h3>
                                <p class="text-sm text-gray-500 line-clamp-2">Juicy beef patty with lettuce, tomato,
                                    and cheese</p>
                                <p class="text-sm text-gray-500 mt-1"><i class="fas fa-utensils text-primary"></i>
                                    Grand Plaza Hotel</p>
                                <div class="flex items-center justify-between mt-3 pt-3 border-t border-gray-100">
                                    <span class="text-lg font-bold text-primary">$14.99</span>
                                    <button class="btn-primary py-1.5 px-4 text-sm"><i class="fas fa-plus mr-1"></i>
                                        Add</button>
                                </div>
                            </div>
                        </div>
                    @endfor
                @endforelse
            </div>
        </div>
    </section>

    <!-- ============================================ -->
    <!-- HOW IT WORKS SECTION -->
    <!-- ============================================ -->
    <section class="py-12 md:py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <span class="bg-primary/10 text-primary font-medium px-3 py-1 rounded-full text-sm">How It Works</span>
                <h2 class="text-3xl md:text-4xl font-heading font-bold text-secondary mb-3">Get Food in 3 Simple Steps
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Order delicious food from nearby hotels with ease
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div
                        class="w-20 h-20 bg-primary-bg rounded-full flex items-center justify-center text-3xl mx-auto mb-4 relative">
                        <i class="fas fa-search text-primary"></i>
                        <span
                            class="absolute -top-2 -right-2 bg-primary text-white w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold">1</span>
                    </div>
                    <h3 class="text-xl font-heading font-bold text-secondary mb-2">Search & Discover</h3>
                    <p class="text-gray-600 text-sm">Search for food, hotels, or browse by location. Find exactly what
                        you're craving.</p>
                </div>

                <div class="text-center">
                    <div
                        class="w-20 h-20 bg-primary-bg rounded-full flex items-center justify-center text-3xl mx-auto mb-4 relative">
                        <i class="fas fa-shopping-cart text-primary"></i>
                        <span
                            class="absolute -top-2 -right-2 bg-primary text-white w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold">2</span>
                    </div>
                    <h3 class="text-xl font-heading font-bold text-secondary mb-2">Order & Customize</h3>
                    <p class="text-gray-600 text-sm">Add your favorite dishes to cart, customize your order, and
                        confirm.</p>
                </div>

                <div class="text-center">
                    <div
                        class="w-20 h-20 bg-primary-bg rounded-full flex items-center justify-center text-3xl mx-auto mb-4 relative">
                        <i class="fas fa-utensils text-primary"></i>
                        <span
                            class="absolute -top-2 -right-2 bg-primary text-white w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold">3</span>
                    </div>
                    <h3 class="text-xl font-heading font-bold text-secondary mb-2">Enjoy Your Meal</h3>
                    <p class="text-gray-600 text-sm">Track your order and enjoy delicious food from local hotels
                        delivered to you.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================ -->
    <!-- STATISTICS SECTION -->
    <!-- ============================================ -->
    <section class="py-12 md:py-16 bg-[#E85D04] text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-4xl md:text-5xl font-heading font-bold">{{ $totalVendors ?? 50 }}+</div>
                    <p class="text-white/80 text-sm mt-1">Partner Hotels</p>
                </div>
                <div>
                    <div class="text-4xl md:text-5xl font-heading font-bold">{{ $totalMenuItems ?? 200 }}+</div>
                    <p class="text-white/80 text-sm mt-1">Menu Items</p>
                </div>
                <div>
                    <div class="text-4xl md:text-5xl font-heading font-bold">{{ $totalOrders ?? 1000 }}+</div>
                    <p class="text-white/80 text-sm mt-1">Happy Customers</p>
                </div>
                <div>
                    <div class="text-4xl md:text-5xl font-heading font-bold">4.8</div>
                    <p class="text-white/80 text-sm mt-1">Average Rating</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================ -->
    <!-- CTA SECTION -->
    <!-- ============================================ -->
    <section class="py-12 md:py-20 bg-gray-700 overflow-hidden">
        <div class="absolute inset-0 bg-[url('/images/hero-pattern.png')] bg-repeat opacity-10"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
            <h2 class="text-3xl md:text-4xl font-heading font-bold mb-4">Ready to Discover Amazing Food?</h2>
            <p class="text-lg md:text-xl text-white/90 mb-8 max-w-2xl mx-auto">Join thousands of food lovers exploring
                local hotels and their delicious menus.</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('register') }}"
                    class="bg-white text-primary hover:bg-gray-100 font-bold py-3 px-8 rounded-lg transition-all duration-200 transform hover:scale-105 shadow-lg">
                    Get Started Now <i class="fas fa-arrow-right ml-1"></i>
                </a>
                <a href=""
                    class="bg-white/20 backdrop-blur-sm text-white hover:bg-white/30 font-bold py-3 px-8 rounded-lg transition-all duration-200 border border-white/30">
                    Browse Hotels
                </a>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // ============================================
                // AUTOCOMPLETE / SEARCH SUGGESTIONS
                // ============================================
                const searchInput = document.getElementById('search-input');
                const locationInput = document.getElementById('location-input');

                // Simple autocomplete for search
                if (searchInput) {
                    searchInput.addEventListener('input', function() {
                        const query = this.value;
                        if (query.length > 2) {
                            // You can implement AJAX search suggestions here
                            console.log('Searching for:', query);
                        }
                    });
                }

                // ============================================
                // ADD TO CART FUNCTIONALITY
                // ============================================
                document.querySelectorAll('.add-to-cart').forEach(button => {
                    button.addEventListener('click', function() {
                        const itemId = this.dataset.id;
                        // Add to cart logic here
                        this.innerHTML = '<i class="fas fa-check mr-1"></i> Added';
                        this.classList.remove('btn-primary');
                        this.classList.add('bg-green-500', 'hover:bg-green-600');

                        setTimeout(() => {
                            this.innerHTML = '<i class="fas fa-plus mr-1"></i> Add';
                            this.classList.remove('bg-green-500', 'hover:bg-green-600');
                            this.classList.add('btn-primary');
                        }, 2000);
                    });
                });

                // ============================================
                // LOCATION AUTO-DETECT
                // ============================================
                if (navigator.geolocation && locationInput) {
                    const detectBtn = document.createElement('button');
                    detectBtn.type = 'button';
                    detectBtn.className =
                        'absolute right-3 top-1/2 -translate-y-1/2 text-primary hover:text-primary-dark text-sm font-medium';
                    detectBtn.innerHTML = '<i class="fas fa-crosshairs"></i> Detect';
                    detectBtn.title = 'Detect my location';

                    const parent = locationInput.parentElement;
                    parent.style.position = 'relative';
                    parent.appendChild(detectBtn);

                    detectBtn.addEventListener('click', function() {
                        navigator.geolocation.getCurrentPosition(
                            function(position) {
                                // Convert coordinates to city name using reverse geocoding
                                fetch(
                                        `https://api.opencagedata.com/geocode/v1/json?q=${position.coords.latitude}+${position.coords.longitude}&key=YOUR_API_KEY`
                                        )
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.results && data.results.length > 0) {
                                            const components = data.results[0].components;
                                            const city = components.city || components.town ||
                                                components.village || 'Unknown';
                                            locationInput.value = city;
                                        }
                                    })
                                    .catch(() => {
                                        locationInput.value = 'Kathmandu';
                                    });
                            },
                            function() {
                                // Fallback
                                locationInput.placeholder = 'Enter location manually';
                            }
                        );
                    });
                }
            });
        </script>




    </body>

    </html>
