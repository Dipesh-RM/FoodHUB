<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
<section class="py-8 md:py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Search Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-heading font-bold text-secondary">Search Results</h1>
            <p class="text-gray-500">
                @if($query)
                    Showing results for "<strong>{{ $query }}</strong>"
                @endif
                @if($location)
                    in "<strong>{{ $location }}</strong>"
                @endif
                @if($cuisine)
                    ({{ $cuisine }} cuisine)
                @endif
            </p>
            <p class="text-sm text-gray-400 mt-1">{{ $vendors->total() }} hotels found</p>
        </div>

        <!-- Search Filters -->
        <div class="bg-white rounded-xl shadow-soft p-4 mb-8">
            <form action="{{ route('search') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <input type="text" name="q" value="{{ $query }}" placeholder="Search food..." class="input-primary">
                <input type="text" name="location" value="{{ $location }}" placeholder="Location..." class="input-primary">
                <select name="cuisine" class="input-primary">
                    <option value="">All Cuisines</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ $cuisine == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn-primary"><i class="fas fa-search mr-2"></i> Filter</button>
            </form>
        </div>

        <!-- Results Grid -->
        @if($vendors->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($vendors as $vendor)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 group">
                    <div class="relative">
                        <img src="{{ $vendor->logo ? asset('storage/' . $vendor->logo) : 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=400&h=250&fit=crop' }}"
                             alt="{{ $vendor->company_name }}"
                             class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute bottom-3 right-3 bg-white/90 backdrop-blur-sm px-2.5 py-1 rounded-lg flex items-center gap-1">
                            <span class="text-yellow-500">★</span>
                            <span class="text-sm font-semibold text-gray-800">4.8</span>
                            <span class="text-xs text-gray-500">(245)</span>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-heading font-semibold text-lg text-secondary">{{ $vendor->company_name }}</h3>
                        <p class="text-gray-500 text-sm"><i class="fas fa-map-marker-alt text-primary w-4"></i> {{ $vendor->city ?? 'Nepal' }}</p>

                        <!-- Display matching menu items -->
                        <div class="mt-2">
                            @foreach($vendor->menuItems->take(3) as $item)
                                <div class="flex items-center justify-between text-sm py-1 border-b border-gray-50">
                                    <span class="text-gray-700">{{ $item->tittle }}</span>
                                    <span class="font-semibold text-primary">${{ number_format($item->price - ($item->dicount ?? 0), 2) }}</span>
                                </div>
                            @endforeach
                            @if($vendor->menuItems->count() > 3)
                                <p class="text-xs text-gray-400 mt-1">+{{ $vendor->menuItems->count() - 3 }} more items</p>
                            @endif
                        </div>

                        <div class="flex items-center justify-between mt-3 pt-3 border-t border-gray-100">
                            <span class="text-sm text-gray-500">Min. order: <span class="font-semibold text-gray-700">$10</span></span>
                            <a href="{{ route('hotels.menu', $vendor->id) }}" class="btn-primary py-2 px-4 text-sm">View Menu</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $vendors->appends(request()->query())->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <div class="text-6xl mb-4">🔍</div>
                <h3 class="text-2xl font-heading font-bold text-secondary mb-2">No Results Found</h3>
                <p class="text-gray-500">We couldn't find any hotels matching your search.</p>
                <div class="mt-4">
                    <a href="{{ route('home') }}" class="btn-primary inline-block">Go Back Home</a>
                </div>
            </div>
        @endif
    </div>
</section>
</body>
</html>



