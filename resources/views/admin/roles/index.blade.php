{{-- @canany(['role-create', 'role-edit', 'role-delete']) --}}
<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Roles List') }}
        </h2>
    </x-slot>

    <div class="d-flex justify-content-center align-items-center min-vh-50 bg-light">
        <div class="card border-0 shadow-lg rounded-4 p-4" style="max-width: 1000px; width: 100%;">
            <div class="card-body">
                {{-- Header --}}
                {{-- <h3 class="text-center fw-bold text-primary mb-4">roles List</h3> --}}

                {{-- Create Button --}}
                <div class="text-center mb-1">
                    <a href="{{ route('admin.roles.create') }}" class="btn btn-success w-100 py-2 rounded-3 shadow-sm">
                        + Create New Role
                    </a>
                </div>

                {{-- roles Table --}}
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
                            @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->email }}</td>
                                <td>
                                    <!-- Edit Button -->
                                    <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-primary btn-sm rounded-3">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm rounded-3" onclick="return confirm('Are you sure you want to delete this role?');">
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
                    {{ $roles->links() }}
                </div>


            </div>
        </div>
    </div>
</x-admin-app-layout>
{{-- @endcanany --}}
