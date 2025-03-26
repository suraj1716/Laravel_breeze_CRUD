<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Create Product') }}
        </h2>
    </x-slot>

    <div class="d-flex justify-content-center align-items-center min-vh-500 bg-light">
        <div class="card border-0 shadow-lg rounded-4 p-4" style="max-width: 500px; width: 100%;">
            <div class="card-body">
                {{-- Header --}}
                {{-- <h3 class="text-center fw-bold text-primary mb-4">Create New role</h3> --}}


                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" />
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" rows="3" class="form-control">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label>Price</label>
                        <input type="text" name="price" class="form-control" value="{{ old('price') }}" />
                        @error('price')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label>Stock</label>
                        <input type="text" name="stock" class="form-control" value="{{ old('stock') }}" />
                        @error('stock')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label>Image Upload</label>
                        <input type="file" name="image" class="form-control"/>   {{-- Removed unnecessary class --}}
                        @error('name'){{$message}} @enderror

                    </div>


                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select id="category_id" name="category_id" class="form-control" required>
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary w-100 py-2 rounded-3 shadow-sm">Create</button>
                    </div>

                    <div class="text-center mt-3">
                        <a href="{{ route('admin.products.index') }}" class="text-muted text-decoration-none">← Back to
                            Products</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-app-layout>
