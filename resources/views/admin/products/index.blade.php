<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Product List') }}
        </h2>
    </x-slot>

    <div class="d-flex justify-content-center align-items-center min-vh-50 bg-light">
        <div class="card border-0 shadow-lg rounded-4 p-4" style="max-width: 1000px; width: 100%;">
            <div class="card-body">

                <!-- Filter & Sorting Form -->
                <form method="GET" action="{{ route('admin.products.index') }}" class="d-flex mb-3">
                    <input type="text" name="search" class="form-control me-2" placeholder="Search products..."
                        value="{{ request('search') }}">

                        <select name="category" id="category" class="form-control me-2"> <!-- Added id="category" -->
                            <option value="">All Categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                        <select name="sort_by" class="form-control me-2" onchange="this.form.submit()">
                            <option value="">Sort By</option>
                            <option value="price_asc" {{ request('sort_by') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_desc" {{ request('sort_by') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                            <option value="date_asc" {{ request('sort_by') == 'date_asc' ? 'selected' : '' }}>Oldest First</option>
                            <option value="date_desc" {{ request('sort_by') == 'date_desc' ? 'selected' : '' }}>Newest First</option>
                        </select>



                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Image</th> <!-- Image Column -->
                            <th>Name</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Created At</th>
                            <th>Category</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>
                                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" width="50"
                                        height="50" style="object-fit: cover;">
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>${{ number_format($product->price, 2) }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>{{ $product->created_at->format('d M Y') }}</td>
                                <td>{{ $product->category->name ?? 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                        class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="mt-3">
                    {{ $products->appends(request()->query())->links() }}
                </div>

            </div>
        </div>
    </div>

    <script>
        // Auto-submit form on category change
        document.getElementById('category').addEventListener('change', function() {
            this.form.submit(); // Auto-submit the form when a category is selected
        });
    </script>
</x-admin-app-layout>
