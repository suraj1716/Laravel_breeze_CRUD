<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Category List') }}
        </h2>
    </x-slot>

    <div class="d-flex justify-content-center align-items-center min-vh-50 bg-light">
        <div class="card border-0 shadow-lg rounded-4 p-4" style="max-width: 1000px; width: 100%;">
            <div class="card-body">
                {{-- Header --}}
                {{-- <h3 class="text-center fw-bold text-primary mb-4">Users List</h3> --}}

                {{-- Create Button --}}
                <div class="text-center mb-1">
                    <a href="{{ route('category.create') }}" class="btn btn-success w-100 py-2 rounded-3 shadow-sm">
                        + Create New Category
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->description }}</td>
                                <td>{{ $category->status == 1 ? 'Visible' : 'Hidden' }}</td>
                                <td>

                                    @can('category-list')
                                        <!-- Edit Button -->
                                        <a href="{{ route('category.edit', $category->id) }}"
                                            class="btn btn-success">Edit</a>
                                    @endcan
                                    <!-- Show Button -->
                                    <a href="{{ route('category.show', $category->id) }}" class="btn btn-info">Show</a>

                                    <!-- Delete Button (Now Using Form) -->
                                    <form action="{{ route('category.destroy', $category->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $categories->links() }}
            </div>
        </div>
    </div>
    </div>
    </div>
</x-app-layout>
