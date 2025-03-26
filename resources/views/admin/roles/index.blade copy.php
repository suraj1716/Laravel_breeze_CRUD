<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Users List') }}
        </h2>
    </x-slot>

    <div class="d-flex justify-content-center align-items-center min-vh-50 bg-light">
        <div class="card border-0 shadow-lg rounded-4 p-4" style="max-width: 1000px; width: 100%;">
            <div class="card-body">
                {{-- Header --}}
                {{-- <h3 class="text-center fw-bold text-primary mb-4">Users List</h3> --}}

                {{-- Create Button --}}
                <div class="text-center mb-1">
                    <a href="{{ route('admin.users.create') }}" class="btn btn-success w-100 py-2 rounded-3 shadow-sm">
                        + Create New User
                    </a>
                </div>

                {{-- Users Table --}}
                <div class="table-responsive">
                    <table class="table table-striped table-hover border rounded-3">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <!-- Edit Button -->
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary btn-sm rounded-3">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm rounded-3" onclick="return confirm('Are you sure you want to delete this user?');">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="d-flex justify-content-center mt-3">
                    {{ $users->links() }}
                </div>


            </div>
        </div>
    </div>
</x-admin-app-layout>
