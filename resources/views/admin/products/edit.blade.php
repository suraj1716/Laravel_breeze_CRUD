<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Edit Role') }}
        </h2>
    </x-slot>

    <div class="d-flex justify-content-center align-items-center min-vh-500 bg-light">
        <div class="card border-0 shadow-lg rounded-4 p-4" style="max-width: 500px; width: 100%;">
            <div class="card-body">
                {{-- Header --}}
                {{-- <h3 class="text-center fw-bold text-primary mb-4">Create New Role</h3> --}}



                <form action="{{ route('admin.category.update', $category->id) }}" method="POST">
                    @csrf {{-- Ensure CSRF protection --}}
                    @method('PUT')
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $category->name }}" />
                        @error('name')
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" rows="3" class="form-control"value="{{ $category->description }}"></textarea> {{-- Fixed closing tag --}}
                        @error('name')
                            {{ $message }}
                        @enderror

                    </div>
                    <div class="mb-3">
                        <label>Status</label>
                        <input type="checkbox" name="status" {{ $category->status == 1 ? 'checked' : '' }} /> Checked:
                        Visible, Unchecked: Hidden
                        @error('name')
                            {{ $message }}
                        @enderror

                    </div>
                    {{-- Submit Button --}}
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary w-100 py-2 rounded-3 shadow-sm">Update </button>
                    </div>

                    {{-- Back Button --}}
                    <div class="text-center mt-3">
                        <a href="{{ route('admin.category.index') }}" class="text-muted text-decoration-none">← Back to Category List</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-admin-app-layout>
