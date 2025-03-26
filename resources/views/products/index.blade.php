<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="container py-5">
        <div class="row">
            <div>
                <form method="GET" action="{{ route('products.index') }}" class="d-flex mb-3" id="filter-form">
                    <input type="text" name="search" class="form-control me-2" placeholder="Search products..." value="{{ request('search') }}">
                    <select name="category" class="form-control me-2" id="category">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <select name="sort_by" class="form-control me-2" id="sort_by">
                        <option value="">Sort By</option>
                        <option value="price_asc" {{ request('sort_by') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="price_desc" {{ request('sort_by') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                        <option value="date_asc" {{ request('sort_by') == 'date_asc' ? 'selected' : '' }}>Oldest First</option>
                        <option value="date_desc" {{ request('sort_by') == 'date_desc' ? 'selected' : '' }}>Newest First</option>
                    </select>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>

<!-- Product Cards -->
<div class="row">
    @foreach ($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card">
                <!-- Product Image -->
                <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <!-- Product Name -->
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <!-- Product Price -->
                    <p class="card-text">${{ number_format($product->price, 2) }}</p>
                    <!-- Product Stock -->
                    <p class="card-text">Stock: {{ $product->stock }}</p>
                    <!-- Product Created At -->
                    <p class="card-text">Created: {{ $product->created_at->format('d M Y') }}</p>
                    <!-- Product Category -->
                    <p class="card-text">Category: {{ $product->category->name ?? 'N/A' }}</p>
                    <!-- Actions -->
                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary btn-sm">View</a>
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- Pagination -->
<div class="mt-3">
    {{ $products->appends(request()->query())->links() }}
</div>

<!-- JavaScript to Enable Auto-submit -->
<script>
    document.getElementById('filter-form').addEventListener('submit', function(event) {
        // If the search input field is empty, prevent form submission
        const searchField = document.querySelector('input[name="search"]');
        if (searchField.value.trim() === '') {
            event.preventDefault(); // Prevent form submission
            alert('Please enter a search term!');
        }
    });

    // Auto-submit form when category or sorting options change
    document.getElementById('category').addEventListener('change', function() {
        document.getElementById('filter-form').submit(); // Submit the form when category is selected
    });

    document.getElementById('sort_by').addEventListener('change', function() {
        document.getElementById('filter-form').submit(); // Submit the form when sort option is selected
    });

    // Preserve search value and submit when typing
    document.querySelector('input[name="search"]').addEventListener('input', function() {
        document.getElementById('filter-form').submit(); // Submit the form when the search term is entered
    });
</script>
</x-app-layout>
