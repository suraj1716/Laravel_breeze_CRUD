<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Create Users') }}
        </h2>
    </x-slot>

    <div class="d-flex justify-content-center align-items-center min-vh-500 bg-light">
        <div class="card border-0 shadow-lg rounded-4 p-4" style="max-width: 500px; width: 100%;">
            <div class="card-body">
                {{-- Header --}}
                {{-- <h3 class="text-center fw-bold text-primary mb-4">Create New User</h3> --}}



                {{-- Form --}}
                <form method="POST" action="{{ route('admin.users.store') }}">
                    @csrf

                    {{-- Name Field --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary">Full Name</label>
                        <input type="text" name="name" class="form-control rounded-3 @error('name') is-invalid @enderror" placeholder="Enter your name" value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email Field --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary">Email Address</label>
                        <input type="email" name="email" class="form-control rounded-3 @error('email') is-invalid @enderror" placeholder="Enter your email" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password Field --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary">Password</label>
                        <input type="password" name="password" class="form-control rounded-3 @error('password') is-invalid @enderror" placeholder="Enter a strong password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                      {{-- Roles --}}
                      <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary">Roles:</label>
                      <select class="form-select" name="roles[]" multiple>
                        <option>---select options---</option>
                    @foreach ($roles as $role)
                     <option value="{{$role->name}}">{{$role->name}}</option>
                    @endforeach
                    </select>
                    </div>

                    {{-- Submit Button --}}
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary w-100 py-2 rounded-3 shadow-sm">Create Account</button>
                    </div>

                    {{-- Back Button --}}
                    <div class="text-center mt-3">
                        <a href="{{ route('admin.users.index') }}" class="text-muted text-decoration-none">← Back to Users</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-app-layout>
