<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Create Role') }}
        </h2>
    </x-slot>

    <div class="d-flex justify-content-center align-items-center min-vh-500 bg-light">
        <div class="card border-0 shadow-lg rounded-4 p-4" style="max-width: 500px; width: 100%;">
            <div class="card-body">
                {{-- Header --}}
                {{-- <h3 class="text-center fw-bold text-primary mb-4">Create New role</h3> --}}



                {{-- Form --}}
                <form method="POST" action="{{ route('admin.roles.store') }}">
                    @csrf

                    {{-- Name Field --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary">Position</label>
                        <input type="text" name="name" class="form-control rounded-3 @error('name') is-invalid @enderror" placeholder="Enter the Position" value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-2">
                        <h3>Permissions:</h3>
                        @foreach ($permissions as $permission)
                            <label>
                                <input class="ml-4" type="checkbox" name="permissions[]" value="{{$permission->name}}"
                                    @if(in_array($permission->name, old('permissions', []))) checked @endif>
                                {{$permission->name}} <br/>
                            </label>
                        @endforeach
                    </div>





                    {{-- Submit Button --}}
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary w-100 py-2 rounded-3 shadow-sm">Create Account</button>
                    </div>

                    {{-- Back Button --}}
                    <div class="text-center mt-3">
                        <a href="{{ route('admin.roles.index') }}" class="text-muted text-decoration-none">← Back to roles</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-app-layout>
