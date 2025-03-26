<x-app-layout>
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



                <div class="mb-3">
                    <label>Name</label>
                    <p>{{ $category->name }}</p>
                </div>
                <div class="mb-3">
                    <label>Description</label>
                    <p>{{ $category->description }}</p>

                </div>
                <div class="mb-3">
                    <label>Status</label>
                    <p>{{ $category->status == 1 ? 'checked' : '' }}</p>

                </div>


            </div>
        </div>
    </div>

</x-app-layout>
